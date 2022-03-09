<?php

namespace Database\Factories;

use App\Models\Signa;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailResepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //random 0 untuk non racikan, 1 untuk racikan
        $jenis = rand(0,1);
        if($jenis == 0)
            //jika jenis 0 maka tidak memiliki nama racikan / alias
            $alias = null;
        else
            //jika jenis racikan 1 maka memiliki nama racikan = random sentence
            $alias = $this->faker->sentence(rand(1,3));

        return [
            'jenis_racikan' => $jenis,
            'nama_racikan' => $alias,
            'signa_id' =>Signa::all()->random()->id,
        ];
    }
}
