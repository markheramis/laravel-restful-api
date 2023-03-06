<?php
namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Interfaces\UserInterface;
use App\Interfaces\ActivationInterface;
use App\Interfaces\ActivationRepositoryInterface;
use App\Traits\RepositoryTrait;

class ActivationRepository implements ActivationRepositoryInterface
{
    use RepositoryTrait;

    /**
     * The Activation model FQCN.
     *
     * @var string
     */
    protected $model = \App\Models\Activation::class;
    
    /**
     * The activation expiration time, in seconds.
     *
     * @var integer
     */
    protected $expires = 259200;

    /**
     * {@inheritdoc}
     */
    public function create(UserInterface $user): ActivationInterface
    {
        $activation = $this->createModel();
        $code = $this->generateActivationCode();
        $activation->fill([
            'code' => $code,
        ]);
        $activation->user_id = $user->getUserId();
        $activation->save();
        return $activation;
    }

    /**
     * {@inheritdoc}
     */
    public function get(UserInterface $user, string $code = null): ActivationInterface
    {
        $expires = $this->expires();
        return $this
            ->createModel()
            ->newQuery()
            ->where('user_id', $user->getUserId())
            ->where('completed', false)
            ->where('created_at', '>', $expires)
            ->when($code, function ($query, $code) {
                return $query->where('code', $code);
            })
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function exists(UserInterface $user, string $code = null): bool
    {
        return (bool) $this->get($user, $code);
    }

    /**
     * {@inheritdoc}
     */
    public function complete(UserInterface $user, string $code): bool
    {
        $expires = $this->expires();
        $activation = $this
            ->createModel()
            ->newQuery()
            ->where('user_id', $user->getUserId())
            ->where('code', $code)
            ->where('completed', false)
            ->where('created_at', '>', $expires)
            ->first();
        if (! $activation) {
            return false;
        }
        $activation->fill([
            'completed'    => true,
            'completed_at' => Carbon::now(),
        ]);
        $activation->save();
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function completed(UserInterface $user): bool
    {
        $userId = $user->getUserId();
        return $this
            ->createModel()
            ->newQuery()
            ->where('user_id', $userId)
            ->where('completed', true)
            ->exists();
    }

    /**
     * {@inheritdoc}
     */
    public function remove(UserInterface $user): bool
    {
        $userId = $user->getUserId();
        $activation = $this
            ->createModel()
            ->newQuery()
            ->where('user_id', $userId)
            ->where('completed', true)
            ->first();
        if (! $activation) {
            return false;
        }
        return $activation->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function removeExpired(): bool
    {
        $expires = $this->expires();
        return $this
            ->createModel()
            ->newQuery()
            ->where('completed', false)
            ->where('created_at', '<', $expires)
            ->delete();
    }

    /**
     * Returns the expiration date.
     *
     * @return \Carbon\Carbon
     */
    protected function expires(): Carbon
    {
        return Carbon::now()->subSeconds($this->expires);
    }

    /**
     * Returns the random string used for the activation code.
     *
     * @return string
     */
    protected function generateActivationCode(): string
    {
        return Str::random(32);
    }

}