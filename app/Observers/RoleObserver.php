<?php

namespace App\Observers;

use App\Models\Role;

use App\Events\Role\RoleCreated;
use App\Events\Role\RoleUpdated;
use App\Events\Role\RoleDeleted;
use App\Events\Role\RoleRestored;
use App\Events\Role\RoleForceDeleted;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        if (config("broadcast.default") == "pusher") {
            RoleCreated::dispatch($role->id);
        }
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        if (config("broadcast.default") == "pusher") {
            RoleUpdated::dispatch($role->id);
        }
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        if (config("broadcast.default") == "pusher") {
            RoleDeleted::dispatch($role->id);
        }
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        if (config("broadcast.default") == "pusher") {
            RoleRestored::dispatch($role->id);
        }
    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        if (config("broadcast.default") == "pusher") {
            RoleForceDeleted::dispatch($role->id);
        }
    }
}
