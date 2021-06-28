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
            $table->date('birth')->nullable();
            $table->string('type_doc', 20)->nullable();
            $table->string('n_doc', 20)->unique();
            $table->string('name',50);
            $table->string('last_name');
            $table->string('phone',50)->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->boolean('ashkenasi')->nullable();
            $table->string('gender', 100)->nullable();
            $table->string('registroH')->nullable();
            $table->char('type_patient', 4);

            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('nationality_id')->nullable();
            $table->unsignedBigInteger('medical_institution_id')->nullable();
            $table->unsignedBigInteger('surgery_institution_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('derived_by_id')->nullable();
            $table->unsignedBigInteger('breed_id')->nullable();
            $table->longText('obs')->nullable();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict');
            $table->foreign('nationality_id')->references('id')->on('countries')->onDelete('restrict');
            $table->foreign('medical_institution_id')->references('id')->on('medical_institutions')->onDelete('restrict');
            $table->foreign('surgery_institution_id')->references('id')->on('medical_institutions')->onDelete('restrict');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('restrict');
            $table->foreign('derived_by_id')->references('id')->on('doctors')->onDelete('restrict');
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
