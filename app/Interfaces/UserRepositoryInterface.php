<?php

namespace App\Interfaces;

use Closure;
use App\Interfaces\UserInterface;

interface UserRepositoryInterface {

    /**
     * Finds a user by the given primary key.
     *
     * @param int $id
     *
     * @return \App\Interfaces\UserInterface|null
     */
    public function findById(int $id): ?UserInterface;

    /**
     * Finds a user by the given credentials.
     *
     * @param array $credentials
     *
     * @return \App\Interfaces\UserInterface|null
     */
    public function findByCredentials(array $credentials): ?UserInterface;

    /**
     * Records a login for the given user.
     *
     * @param \App\Interfaces\UserInterface $user
     *
     * @return bool
     */
    public function recordLogin(UserInterface $user): bool;

    /**
     * Records a logout for the given user.
     *
     * @param \App\Interfaces\UserInterface $user
     *
     * @return bool
     */
    public function recordLogout(UserInterface $user): bool;

    /**
     * Validate the password of the given user.
     *
     * @param \App\Interfaces\UserInterface $user
     * @param array                                   $credentials
     *
     * @return bool
     */
    public function validateCredentials(UserInterface $user, array $credentials): bool;

    /**
     * Validate if the given user is valid for creation.
     *
     * @param array $credentials
     *
     * @return bool
     */
    public function validForCreation(array $credentials): bool;

    /**
     * Validate if the given user is valid for updating.
     *
     * @param \App\Interfaces\UserInterface|int $user
     * @param array                                       $credentials
     *
     * @return bool
     */
    public function validForUpdate(UserInterface $user, array $credentials): bool;

    /**
     * Creates a user.
     *
     * @param array         $credentials
     * @param \Closure|null $callback
     *
     * @return \App\Interfaces\UserInterface|null
     */
    public function create(array $credentials, Closure $callback = null): ?UserInterface;

    /**
     * Updates a user.
     *
     * @param \App\Interfaces\UserInterface|int $user
     * @param array                                       $credentials
     *
     * @return \App\Interfaces\UserInterface
     */
    public function update(UserInterface $user, array $credentials): UserInterface;
}
