<?php

namespace App\Hashers;

use App\Interfaces\HasherInterface;

class NativeHasher implements HasherInterface {

    /**
     * {@inheritdoc}
     */
    public function hash(string $value): string {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    /**
     * {@inheritdoc}
     */
    public function check(string $value, string $hashedValue): bool {
        return password_verify($value, $hashedValue);
    }

}
