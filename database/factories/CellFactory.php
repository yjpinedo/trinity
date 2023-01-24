<?php

namespace Database\Factories;

use App\Models\Neighborhood;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cell>
 */
class CellFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->sentence(4);
        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'description' => $this->faker->text(),
            'neighborhood_id' => Neighborhood::all()->random()->id,
            'state' => $this->faker->randomElement(['Activo', 'Inactivo']),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
