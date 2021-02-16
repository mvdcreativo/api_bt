<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(TypeSampleSeeder::class);
        $this->call(TopographySeeder::class);
        $this->call(TumorLineageSeeder::class);
        $this->call(TnmSeeder::class);
        $this->call(EvolutionSeeder::class);
        $this->call(EstadioSeeder::class);
        $this->call(TypeSurgerySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(BreedSeeder::class);
        $this->call(MedicalInstitutionSeeder::class);
        $this->call(KinshipSeeder::class);
        
    }
}
