<?php
namespace App\Interfaces;

use App\Interfaces\ActivationInterface;

interface ActivationRepositoryInterface {
    /**
     * Create a new activation record and code.
     *
     * @param UserInterface $user
     *
     * @return ActivationInterface
     */
    public function create(UserInterface $user): ActivationInterface;

    /**
     * Gets the activation for the given user.
     *
     * @param UserInterface $user
     * @param string|null                             $code
     *
     * @return ActivationInterface|null
     */
    public function get(UserInterface $user, string $code = null): ?ActivationInterface;

    /**
     * Checks if a valid activation for the given user exists.
     *
     * @param UserInterface $user
     * @param string|null                             $code
     *
     * @return bool
     */
    public function exists(UserInterface $user, string $code = null): bool;

    /**
     * Completes the activation for the given user.
     *
     * @param UserInterface $user
     * @param string                                  $code
     *
     * @return bool
     */
    public function complete(UserInterface $user, string $code): bool;

    /**
     * Checks if a valid activation has been completed.
     *
     * @param UserInterface $user
     *
     * @return bool
     */
    public function completed(UserInterface $user): bool;

    /**
     * Remove an existing activation (deactivate).
     *
     * @param UserInterface $user
     *
     * @return bool|null
     */
    public function remove(UserInterface $user): ?bool;

    /**
     * Remove expired activation codes.
     *
     * @return bool
     */
    public function removeExpired(): bool;
}