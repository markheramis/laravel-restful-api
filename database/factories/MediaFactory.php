<?php

namespace Database\Factories;

use Storage;
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
        $status = $this->faker->randomElement(["public", "private"]);

        $public = ($status == "public") ? "public/" : "";
        $file = $this->faker->image(storage_path("app/" . $public . "media"), 200, 200, "cats", false, true, "Faker", true);
        $file_info = pathinfo(storage_path("app/" . $public . "media/$file"));
        $url = ($status == "public") ? asset("storage/media/$file") : "";
        $path = $public."media/".$file;
        return [
            "path" => $path,
            "url" => $url,
            "type" => $file_info['extension'],
            "meta" => [
                "is_test" => true
            ],
            "status" => $status,
        ];
    }
}
