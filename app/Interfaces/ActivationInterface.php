<?php
namespace App\Interfaces;

interface ActivationInterface
{
    /**
     * Returns the random string used for the activation code.
     *
     * @return string
     */
    public function getCode(): string;
}