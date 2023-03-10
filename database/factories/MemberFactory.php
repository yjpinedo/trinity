<?php

namespace Database\Factories;

use App\Models\Cell;
use App\Models\Neighborhood;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->email(),
            'document_type' => $this->faker->randomElement(['Registro civil', 'Tarjeta de identidad', 'Cédula de ciudanía', 'Tarjeta de extranjería', 'Pasaporte']),
            'document_number' => $this->faker->unique()->randomNumber(9),
            'date_of_birth' => $this->faker->date(),
            'sex' => $this->faker->randomElement(['Femenino', 'Masculino']),
            'civil_state' => $this->faker->randomElement(['Soltero', 'Casado', 'Conviviente civil', 'Divorciado', 'Viudo']),
            'address' => $this->faker->streetAddress(),
            'phone' => $this->faker->unique()->tollFreePhoneNumber(),
            'cellphone' => $this->faker->unique()->tollFreePhoneNumber(),
            'is_baptized' => $this->faker->randomElement(['Si', 'No']),
            'state' => $this->faker->randomElement(['Activo', 'Inactivo']),
            'neighborhood_id' => Neighborhood::all()->random()->id,
            'created_at' => $this->faker->dateTimeBetween(date('Y-m-d', strtotime('2022-01-01')), now()),
        ];
    }
}
