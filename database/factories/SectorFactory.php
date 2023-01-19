<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sector>
 */
class SectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->sentence(2);
        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'description' => $this->faker->text(),
            'state' => $this->faker->randomElement(['Activo', 'Inactivo']),
            //'image' => 'sectors/' . $this->faker->image('public/storage/sectors', 640, 480, null, false),
        ];
    }
}
