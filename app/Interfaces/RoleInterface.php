<?php

namespace App\Interfaces;

use IteratorAggregate;

/**
 *
 * @author Mark
 */
interface RoleInterface {

    /**
     * Returns the role's primary key.
     *
     * @return int
     */
    public function getRoleId(): int;

    /**
     * Returns the role's slug.
     *
     * @return string
     */
    public function getRoleSlug(): string;

    /**
     * Returns all users for the role.
     *
     * @return \IteratorAggregate
     */
    public function getUsers(): IteratorAggregate;

    /**
     * Returns the users model.
     *
     * @return string
     */
    public static function getUsersModel(): string;

    /**
     * Sets the users model.
     *
     * @param string $usersModel
     *
     * @return void
     */
    public static function setUsersModel(string $usersModel): void;
}
