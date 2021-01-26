<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10);
            $table->date('birth');
            $table->string('type_doc', 20);
            $table->string('n_doc', 20);
            $table->string('name',50);
            $table->string('last_name');
            $table->string('phone',50);
            $table->string('address');
            $table->string('email');
            $table->boolean('ashkenasi');
            $table->string('gender', 100);
            $table->char('type_patient', 4);
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('medical_institution_id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('breed_id');
            $table->longText('obs')->nullable();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict');
            $table->foreign('medical_institution_id')->references('id')->on('medical_institutions')->onDelete('restrict');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('restrict');
            $table->foreign('breed_id')->references('id')->on('breeds')->onDelete('restrict');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
