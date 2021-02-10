<?php

namespace Database\Seeders;

use App\Models\Topography;
use Illuminate\Database\Seeder;

class TopographySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topography = new Topography();
        $topography->name =  "Esófago cervical";
        $topography->cie10 =  15;
        $topography->save();

        $topography = new Topography();
        $topography->name =  "Recto";
        $topography->cie10 =  20;
        $topography->save();

        $topography = new Topography();
        $topography->name =  "Pleura";
        $topography->cie10 =  905;
        $topography->save();

    }
}
