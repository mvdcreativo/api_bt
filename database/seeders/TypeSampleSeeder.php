<?php

namespace Database\Seeders;

use App\Models\TypeSample;
use Illuminate\Database\Seeder;

class TypeSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_sample = new TypeSample;
        $type_sample->name =  "Tejido tumoral congelado";
        $type_sample->save();

        $type_sample = new TypeSample;
        $type_sample->name =  "Taco parafinado de tumor";
        $type_sample->save();

        $type_sample = new TypeSample;
        $type_sample->name =  "Taco tumoral congelado";
        $type_sample->save();
    }
}
