<?php

namespace Database\Seeders;

use App\Models\TypeSurgery;
use Illuminate\Database\Seeder;

class TypeSurgerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_surgery = new TypeSurgery;
        $type_surgery->name =  "Esofagectomía";
        $type_surgery->save();        
        
        $type_surgery = new TypeSurgery;
        $type_surgery->name =  "Resección anterior de recto";
        $type_surgery->save();        
        
        $type_surgery = new TypeSurgery;
        $type_surgery->name =  "Biopsia";
        $type_surgery->save();        
        
    }
}
