<?php

namespace App\Hashers;

/**
 * Description of BcryptHasher
 *
 * @author Mark
 */
class BcryptHasher implements \App\Interfaces\HasherInterface {

    use HasherTrait;

    /**
     * The hash strength.
     *
     * @var int
     */
    public $strength = 8;

    public function check(string $value, string $hashedValue): bool {
        return $this->slowEquals(crypt($value, $hashedValue), $hashedValue);
    }

    public function hash(string $value): string {
        $salt = $this->createSalt();
        $strength = str_pad($this->strength, 2, '0', STR_PAD_LEFT);
        $prefix = '$2y$';
        return crypt($value, $prefix . $strength . '$' . $salt . '$');
    }

}
