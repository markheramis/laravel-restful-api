<?php

namespace App\Security;

use App\Security\PermissionsInterface;
use App\Security\PermissibleInterface;
/**
 *
 * @author Mark
 */
interface PermissibleInterface {

    /**
     * Returns the Permissions instance.
     *
     * @return \App\Security\PermissionsInterface
     */
    public function getPermissionsInstance(): PermissionsInterface;

    /**
     * Adds a permission.
     *
     * @param string $permission
     * @param bool   $value
     *
     * @return \App\Security\PermissibleInterface
     */
    public function addPermission(string $permission, bool $value = true): PermissibleInterface;

    /**
     * Updates a permission.
     *
     * @param string $permission
     * @param bool   $value
     * @param bool   $create
     *
     * @return \App\Security\PermissibleInterface
     */
    public function updatePermission(string $permission, bool $value = true, bool $create = false): PermissibleInterface;

    /**
     * Removes a permission.
     *
     * @param string $permission
     *
     * @return \App\Security\PermissibleInterface
     */
    public function removePermission(string $permission): PermissibleInterface;
}
