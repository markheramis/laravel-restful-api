<?php

namespace App\Security;

class StrictPermissions implements \App\Security\PermissionsInterface {

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
            $this->preparePermissions($prepared, $this->getPermissions());
        }
        return $prepared;
    }


}
