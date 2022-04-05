<?php

namespace App\Models;

use App\Models\Worklist;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Cartalyst\Sentinel\Users\EloquentUser as Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use HasApiTokens, Authenticatable, MustVerifyEmail, Notifiable, CanResetPassword, Authorizable, HasFactory, BroadcastsEvents;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'permissions',
        'country_code',
        'phone_number',
        'authy_id', // Temporary.
        'default_factor',
    ];

    /**
     * Array of login column names.
     *
     * @var array
     */
    protected $loginNames = ['email', 'username'];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    #protected $primaryKey = 'slug';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'default_factor',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }


    public function findForPassport($username)
    {
        return $this->where('email', $username)->first();
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function google2fa()
    {
        return $this->hasOne(Google2FA::class);
    }

    public function hasMFA(): bool
    {
        return (bool) ($this->authy_id && $this->phone_number);
    }

    public function getPermissionsAttribute($value)
    {
        return ($value) ? $value : [];
    }

    public function allPermissions()
    {
        $role_permissions = $this->roles()
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($role) {
                return $role->permissions;
            })
            ->toArray();
        $user_permissions = $this->permissions;
        $all_permissions =  array_merge($role_permissions, $user_permissions);
        return (array) array_keys(
            array_filter(
                array_merge(...$all_permissions)
            )
        );
    }

    public function meta()
    {
        return $this->hasMany(UserMeta::class);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn($event)
    {
        return new PrivateChannel('user');
    }

    /**
     * The event's broadcast name.
     * @todo create tests automations
     * @return string
     */
    public function broadcastAs($event)
    {
        return match ($event) {
            'created'   => 'user.created',
            'updated'   => 'user.updated',
            'deleted'   => 'user.deleted',
            default => null,
        };
    }
}
