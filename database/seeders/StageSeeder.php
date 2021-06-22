<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stage::create(['name'=>'Solicitud de estudio de ...a', 'active'=>1, 'end'=> false]);
        Stage::create(['name'=>'Solicitud de estudio de ...b', 'active'=>1, 'end'=> false]);
        Stage::create(['name'=>'Solicitud de estudio de ...c', 'active'=>1, 'end'=> false]);
        Stage::create(['name'=>'Solicitud de estudio de ...d', 'active'=>1, 'end'=> false]);
    }
}
