<?php

namespace App\Interfaces;

/**
 *
 * @author Mark
 */
interface HasherInterface {

    /**
     * Hash the given value.
     *
     * @param string $value
     *
     * @throws \RuntimeException
     *
     * @return string
     */
    public function hash(string $value): string;

    /**
     * Checks the string against the hashed value.
     *
     * @param string $value
     * @param string $hashedValue
     *
     * @return bool
     */
    public function check(string $value, string $hashedValue): bool;
}
