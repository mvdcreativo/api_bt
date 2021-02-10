<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state = new State;
        $state->name = "Montevideo";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Canelones";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Maldonado";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Artigas";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Salto";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Rivera";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Cerro Largo";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Flores";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Lavalleja";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Florida";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Durazno";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Paysandú";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Treinta y Tres";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Río Negro";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Tacuarembo";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Rocha";
        $state->code = "";
        $state->country_id = 1;
        $state->save();
        
        $state = new State;
        $state->name = "Colonia";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "Soriano";
        $state->code = "";
        $state->country_id = 1;
        $state->save();

        $state = new State;
        $state->name = "San José";
        $state->code = "";
        $state->country_id = 1;
        $state->save();


    }
}
