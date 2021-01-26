<?php

namespace App\Models;



use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Cviebrock\EloquentSluggable\Sluggable;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Cartalyst\Sentinel\Users\EloquentUser as Model;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use HasApiTokens, Authenticatable, MustVerifyEmail, Notifiable, CanResetPassword, Authorizable, Sluggable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'last_name',
        'first_name',
        'permissions',
    ];
    
    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->uuid = Str::uuid();
        });
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'username'
            ]
        ];
    }
}
