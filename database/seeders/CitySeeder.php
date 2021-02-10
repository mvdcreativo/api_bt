<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = new City;
        $city->name = "Montevideo";
        $city->code = "";
        $city->state_id = 1;
        $city->save();

        $city = new City;
        $city->name = "Canelones";
        $city->code = "";
        $city->state_id = 2;
        $city->save();

        $city = new City;
        $city->name = "Ciudad de la Costa";
        $city->code = "";
        $city->state_id = 2;
        $city->save();

        $city = new City;
        $city->name = "Maldonado";
        $city->code = "";
        $city->state_id = 3;
        $city->save();
        
        $city = new City;
        $city->name = "Punta del Este";
        $city->code = "";
        $city->state_id = 3;
        $city->save();
        
        $city = new City;
        $city->name = "Melo";
        $city->code = "";
        $city->state_id = 7;
        $city->save();
                
        $city = new City;
        $city->name = "Río Branco";
        $city->code = "";
        $city->state_id = 7;
        $city->save();
    }
}
