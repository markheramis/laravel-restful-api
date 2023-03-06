<?php

namespace App\Security;

use IteratorAggregate;

/**
 *
 * @author Mark
 */
interface RoleableInterface {

    /**
     * Returns all the associated roles.
     *
     * @return \IteratorAggregate
     */
    public function getRoles(): IteratorAggregate;

    /**
     * Checks if the user is in the given role.
     *
     * @param mixed $role
     *
     * @return bool
     */
    public function inRole($role): bool;

    /**
     * Checks if the user is in any of the given roles.
     *
     * @param array $roles
     *
     * @return bool
     */
    public function inAnyRole(array $roles): bool;
}
