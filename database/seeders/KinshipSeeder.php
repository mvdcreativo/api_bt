<?php

namespace Database\Seeders;

use App\Models\Kinship;
use Illuminate\Database\Seeder;

class KinshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kinship = new Kinship;
        $kinship->name =  "Padre";
        $kinship->save();
        $kinship = new Kinship;
        $kinship->name =  "Madre";
        $kinship->save();
        $kinship = new Kinship;
        $kinship->name =  "Hermana";
        $kinship->save();
        $kinship = new Kinship;
        $kinship->name =  "Hermano";
        $kinship->save();
        $kinship = new Kinship;
        $kinship->name =  "Abuelo";
        $kinship->save();
        $kinship = new Kinship;
        $kinship->name =  "Abuela";
        $kinship->save();
        $kinship = new Kinship;
        $kinship->name =  "Hija";
        $kinship->save();
        $kinship = new Kinship;
        $kinship->name =  "Hijo";
        $kinship->save();
        $kinship = new Kinship;
        $kinship->name =  "Tio/a";
        $kinship->save();
        $kinship = new Kinship;
        $kinship->name =  "Primo/a";
        $kinship->save();
        $kinship = new Kinship;
        $kinship->name =  "Sobrino/a";
        $kinship->save();
        $kinship = new Kinship;
        $kinship->name =  "Nieto";
        $kinship->save();
        $kinship = new Kinship;
        $kinship->name =  "Nieta";
        $kinship->save();

    }
}
