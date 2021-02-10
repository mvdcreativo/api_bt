<?php

namespace Database\Seeders;

use App\Models\Breed;
use Illuminate\Database\Seeder;

class BreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $breed = new Breed;
        $breed->name =  "Caucásico";
        $breed->save();

        $breed = new Breed;
        $breed->name =  "Afro";
        $breed->save();

        $breed = new Breed;
        $breed->name =  "Asiatico";
        $breed->save();
    }
}
