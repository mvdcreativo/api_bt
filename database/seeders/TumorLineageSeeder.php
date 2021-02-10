<?php

namespace Database\Seeders;

use App\Models\TumorLineage;
use Illuminate\Database\Seeder;

class TumorLineageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tumor_lineage = new TumorLineage();
        $tumor_lineage->name =  "Carcinoma";
        $tumor_lineage->save();

        $tumor_lineage = new TumorLineage();
        $tumor_lineage->name =  "Adenocarcinoma";
        $tumor_lineage->save();
        
        $tumor_lineage = new TumorLineage();
        $tumor_lineage->name =  "Mesotelioma";
        $tumor_lineage->save();
    }
}
