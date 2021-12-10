<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => User::factory()->create(),
            "path" => "media/" . $this->faker->bothify('??##??#?#####??##') . ".jpg",
            "description" => $this->faker->imageUrl($width = 640, $height = 480),
            "status" => "public",
        ];
    }
}
