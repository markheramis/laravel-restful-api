<?php

namespace App\Models;

use IteratorAggregate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Security\PermissibleTrait;

class Role extends Model implements \App\Interfaces\RoleInterface {

    use HasFactory;
    use BroadcastsEvents;
    use PermissibleTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions' => 'json',
    ];

    /**
     * The Users model FQCN.
     *
     * @var string
     */
    protected static $usersModel = \App\Models\User::class;

    /**
     * {@inheritdoc}
     */
    public function delete() {
        if ($this->exists && (!method_exists(static::class, 'isForceDeleting') || $this->isForceDeleting())) {
            $this->users()->detach();
        }
        return parent::delete();
    }

    /**
     * The Users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
        return $this->belongsToMany(static::$usersModel, 'role_users', 'role_id', 'user_id')->withTimestamps();
    }

    /**
     * {@inheritdoc}
     */
    public function getUsers(): IteratorAggregate {
        return $this->users;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn($event) {
        return new PrivateChannel('role');
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs($event) {
        return match ($event) {
            'created' => 'role.created',
            'updated' => 'role.updated',
            'deleted' => 'role.deleted',
            default => null,
        };
    }

    public function getRoleId(): int {
        return $this->getKey();
    }

    public function getRoleSlug(): string {
        return $this->slug;
    }

    public static function getUsersModel(): string {
        return static::$usersModel;
    }

    public static function setUsersModel(string $usersModel): void {
        static::$usersModel = $usersModel;
    }

    protected function createPermissions(): \App\Security\PermissionsInterface {
        return new static::$permissionsClass($this->getPermissions());
    }

    public function getRouteKeyName() {
        return 'slug';
    }

}
