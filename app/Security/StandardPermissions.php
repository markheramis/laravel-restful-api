<?php

namespace App\Security;

class StandardPermissions implements PermissionsInterface {

    use PermissionsTrait;

    /**
     * {@inheritdoc}
     */
    protected function createPreparedPermissions(): array {
        $prepared = [];
        if (!empty($this->getSecondaryPermissions())) {
            foreach ($this->getSecondaryPermissions() as $permissions) {
                $this->preparePermissions($prepared, $permissions);
            }
        }
        if (!empty($this->getPermissions())) {
            $permissions = [];
            $this->preparePermissions($permissions, $this->getPermissions());
            $prepared = array_merge($prepared, $permissions);
        }
        return $prepared;
    }
}
