<?php

namespace Database\Seeders;

use App\Models\Evolution;
use Illuminate\Database\Seeder;

class EvolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evolution = new Evolution;
        $evolution->name =  "control";
        $evolution->save();

        $evolution = new Evolution;
        $evolution->name =  "Control";
        $evolution->save();

        $evolution = new Evolution;
        $evolution->name =  "Quimioterapia post recaída";
        $evolution->save();

        $evolution = new Evolution;
        $evolution->name =  "Quimioterapia paliativa";
        $evolution->save();
    }
}
