<?php

namespace Database\Factories;

use Google2FA;
use App\Models\Google2FA as Google2FAModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class Google2FAFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Google2FAModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'secret_key' => Google2FA::generateSecretKey(),
        ];
    }
}
