<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BibleSchool>
 */
class BibleSchoolFactory extends Factory
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
            'teacher_id' => Member::all()->random()->id,
            'state' => $this->faker->randomElement(['Activo', 'Inactivo']),
        ];
    }
}
