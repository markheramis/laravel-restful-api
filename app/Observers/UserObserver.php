<?php

namespace App\Observers;

use App\Models\User;
use App\Repositories\ActivationRepository;

class UserObserver {

    /**
     * 
     * @var ActivationRepository
     */
    protected ActivationRepository $activation;

    /**
     * 
     * @param ActivationRepository $activation
     */
    public function __construct(ActivationRepository $activation) {
        $this->activation = $activation;
    }

    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user) {
        $this->activation->create($user);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user) {
        
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user) {
        
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user) {
        
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user) {
        
    }

}
