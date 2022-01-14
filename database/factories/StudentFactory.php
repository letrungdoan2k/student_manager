<?php

namespace Database\Factories;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imgPath = $this->faker->image(storage_path('app/public/images'), $width = 640, $height = 480, 'cats', false);
        return [
            "name" => $this->faker->name(),
            "faculty_id" => Faculty::all()->random()->id,
            "birthday" => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            "address" => $this->faker->address,
            "image" => "images/" . $imgPath,
            "phone" => $this->faker->regexify('/(01)[0-9]{8}/'),
            "email" => $this->faker->email,
            "gender" => rand(1, 2)
        ];
    }
}
