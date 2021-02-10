<?php

namespace Database\Seeders;

use App\Models\MedicalInstitution;
use Illuminate\Database\Seeder;

class MedicalInstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadio = new MedicalInstitution;
        $estadio->name =  "Asoc. Española";
        $estadio->save();

        $estadio = new MedicalInstitution;
        $estadio->name =  "Casmu";
        $estadio->save();
        $estadio = new MedicalInstitution;
        $estadio->name =  "Médica Uruguaya";
        $estadio->save();

        $estadio = new MedicalInstitution;
        $estadio->name =  "Sanatorio Americano";
        $estadio->save();

        $estadio = new MedicalInstitution;
        $estadio->name =  "Hospital Británico";
        $estadio->save();
        
        $estadio = new MedicalInstitution;
        $estadio->name =  "Hospital Militar";
        $estadio->save();

        $estadio = new MedicalInstitution;
        $estadio->name =  "Hospital Policial";
        $estadio->save();

        $estadio = new MedicalInstitution;
        $estadio->name =  "Hospital Pereira Rossell";
        $estadio->save();
    }
}
