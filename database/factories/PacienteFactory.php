<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'apellidos' => $this->faker->name(),
            'nombres' => $this->faker->unique()->name(),
            'cedula'=>Str::random(10)
        ];
    }
}
