<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ResepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'resep_kode' => $this->faker->isbn10(),
            'patient' => $this->faker->name(),
            'doctor' => $this->faker->name(),
            'poli' => $this->faker->company(),
            'additional_data' => $this->faker->paragraphs(rand(3,7),true),
        ];
    }
}
