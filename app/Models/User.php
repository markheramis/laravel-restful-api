<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Cartalyst\Sentinel\Users\EloquentUser as Model;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use HasApiTokens, Authenticatable, MustVerifyEmail, Notifiable, CanResetPassword, Authorizable, HasFactory;

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
        'authy_id' // Temporary.
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
        'password', 'remember_token',
    ];

    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

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

    public function activation()
    {
        return $this->hasOne(Activation::class);
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
        $role_permissions = $this->roles()->orderBy('id', 'desc')->get()->map(function ($role) {
            return $role->permissions;
        })->toArray();
        $user_permissions = $this->permissions;
        return array_merge($role_permissions, $user_permissions);
    }
}
