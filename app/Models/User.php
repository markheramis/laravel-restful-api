<?php

namespace App\Models;

use IteratorAggregate;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Interfaces\UserInterface;
use App\Security\RoleableInterface;
use App\Security\PermissibleTrait;
use App\Security\PermissibleInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Model implements UserInterface, PermissibleInterface, RoleableInterface, AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {

    use HasApiTokens;
    use Authenticatable;
    use MustVerifyEmail;
    use Notifiable;
    use CanResetPassword;
    use Authorizable;
    use HasFactory;
    use PermissibleTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'permissions',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions' => 'json',
    ];

    /**
     * The Roles model FQCN.
     *
     * @var string
     */
    protected static $rolesModel = \App\Models\Role::class;

    /**
     * The Activations model FQCN.
     *
     * @var string
     */
    protected static $activationsModel = \App\Models\Activation::class;

    /**
     * The Throttling model FQCN.
     *
     * @var string
     */
    protected static $throttlingModel = \App\Models\Throttle::class;

    /**
     * Returns an array of login column names.
     *
     * @return array
     */
    public function getLoginNames(): array {
        return $this->loginNames;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserId(): int {
        return $this->getKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLogin(): string {
        return $this->getAttribute($this->getUserLoginName());
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLoginName(): string {
        return reset($this->loginNames);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserPassword(): string {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function delete() {
        $isSoftDeletable = property_exists($this, 'forceDeleting');
        $isSoftDeleted = $isSoftDeletable && !$this->forceDeleting;
        if ($this->exists && !$isSoftDeleted) {
            $this->activations()->delete();
            $this->roles()->detach();
        }

        return parent::delete();
    }

    /**
     * Returns the activations relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activations(): HasMany {
        return $this->hasMany(static::$activationsModel, 'user_id');
    }

    /**
     * Returns the activations model.
     *
     * @return string
     * 
     * @deprecated
     */
    public static function getActivationsModel(): string {
        return static::$activationsModel;
    }

    /**
     * Sets the activations model.
     *
     * @param string $activationsModel
     *
     * @return void
     * 
     * @deprecated
     */
    public static function setActivationsModel(string $activationsModel): void {
        static::$activationsModel = $activationsModel;
    }

    /**
     * Returns the roles relationship.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany {
        return $this->belongsToMany(static::$rolesModel, 'role_users', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles(): IteratorAggregate {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function inRole($role): bool {
        if ($role instanceof RoleInterface) {
            $roleId = $role->getRoleId();
        }
        foreach ($this->roles as $instance) {
            if ($role instanceof RoleInterface) {
                return ($instance->getRoleId() === $roleId);
            } else {
                return ($instance->getRoleId() == $role || $instance->getRoleSlug() == $role);
            }
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function inAnyRole(array $roles): bool {
        foreach ($roles as $role) {
            return ($this->inRole($role));
        }
        return false;
    }

    /**
     * Returns the roles model.
     *
     * @return string
     * 
     * @deprecated
     */
    public static function getRolesModel(): string {
        return static::$rolesModel;
    }

    /**
     * Sets the roles model.
     *
     * @param string $rolesModel
     *
     * @return void
     * 
     * @deprecated
     */
    public static function setRolesModel(string $rolesModel): void {
        static::$rolesModel = $rolesModel;
    }

    /**
     * Creates a permissions object.
     *
     * @return \App\Security\PermissionsInterface
     */
    protected function createPermissions(): \App\Security\PermissionsInterface {
        $userPermissions = $this->getPermissions();
        $rolePermissions = [];
        foreach ($this->roles as $role) {
            $rolePermissions[] = $role->getPermissions();
        }
        return new static::$permissionsClass($userPermissions, $rolePermissions);
    }

    /**
     * Dynamically pass missing methods to the user.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters) {
        $methods = ['hasAccess', 'hasAnyAccess'];

        if (in_array($method, $methods)) {
            $permissions = $this->getPermissionsInstance();

            return call_user_func_array([$permissions, $method], $parameters);
        }

        return parent::__call($method, $parameters);
    }

    public function allPermissions() {
        $role_permissions = $this->roles()
                        ->orderBy('id', 'desc')
                        ->get()
                        ->map(function ($role) {
                            return $role->permissions;
                        })
                        ->toArray()[0];
        $user_permissions = $this->permissions;
        $all_permissions = array_merge(
                $role_permissions,
                $user_permissions
        );
        return (array) array_keys(array_filter($all_permissions));
    }

    /**
     * return permissions or return an empty array
     * 
     * @param array $value
     * @return array
     */
    public function getPermissionsAttribute($value): array {
        return ($value) ? $value : [];
    }

    /**
     * Returns the Media relationship.
     * 
     * @return HasMany
     */
    public function media(): HasMany {
        return $this->hasMany(Media::class);
    }

}
