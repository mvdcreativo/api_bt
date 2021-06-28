<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvolutionPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evolution_patient', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evolution_id');
            $table->unsignedBigInteger('patient_id');
            $table->date('date');
            $table->timestamps();

            $table->foreign('evolution_id')->references('id')->on('evolutions');
            $table->foreign('patient_id')->references('id')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evolution_patient');
    }
}
