<?php

namespace Database\Factories;

use App\Models\Obatalkes;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailRacikanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kuantitas' =>  rand (0, 100) / 10,
            'obatalkes_id' =>Obatalkes::all()->random()->id,
        ];
    }
}
