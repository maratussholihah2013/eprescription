<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resep;
use App\Models\DetailResep;
use App\Models\DetailRacikan;

class ResepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('reseps')->delete();

        Resep::factory(5)->create()->each(function($a) {
            $a->detailReseps()
              ->saveMany(
                  DetailResep::factory(rand(1, 2))->make()
              )->each(function ($d) {
                    if ($d->jenis_racikan==0)                   
                        $d->detailRacikans()->saveMany(DetailRacikan::factory(1)->make());
                    else
                        $d->detailRacikans()->saveMany(DetailRacikan::factory(rand(2, 4))->make());
              });
        });  
    }
}
