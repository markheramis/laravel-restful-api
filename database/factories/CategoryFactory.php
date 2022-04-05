<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $parent_id = null;
        if (rand(0, 1)) {
            $parent = Category::inRandomOrder()->first();
            $parent_id = ($parent) ? $parent->id : null;
        }
        return [
            'name' => $this->faker->text(50),
            'parent_id' => $parent_id,
        ];
    }
}
