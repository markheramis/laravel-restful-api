<?php
namespace App\Interfaces;

interface UserInterface
{
    /**
     * Returns the user primary key.
     *
     * @return int
     */
    public function getUserId(): int;

    /**
     * Returns the user login.
     *
     * @return string
     */
    public function getUserLogin(): string;

    /**
     * Returns the user login attribute name.
     *
     * @return string
     */
    public function getUserLoginName(): string;

    /**
     * Returns the user password.
     *
     * @return string
     */
    public function getUserPassword(): string;
}