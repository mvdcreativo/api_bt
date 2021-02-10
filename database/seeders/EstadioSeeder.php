<?php

namespace Database\Seeders;

use App\Models\Estadio;
use Illuminate\Database\Seeder;

class EstadioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadio = new Estadio;
        $estadio->name =  "III";
        $estadio->save();

        $estadio = new Estadio;
        $estadio->name =  "II";
        $estadio->save();

        $estadio = new Estadio;
        $estadio->name =  "IV";
        $estadio->save();

    }
}
