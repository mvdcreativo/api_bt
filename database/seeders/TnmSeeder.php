<?php

namespace Database\Seeders;

use App\Models\Tnm;
use Illuminate\Database\Seeder;

class TnmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tnm = new Tnm;
        $tnm->name =  "t2n1m0";
        $tnm->save();

        $tnm = new Tnm;
        $tnm->name =  "t3n0m0";
        $tnm->save();

        $tnm = new Tnm;
        $tnm->name =  "no aplica";
        $tnm->save();

    }
}
