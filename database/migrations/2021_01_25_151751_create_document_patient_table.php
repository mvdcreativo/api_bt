<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_patient', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('patient_id');            
            $table->timestamps();

            $table->foreign('document_id')->references('id')->on('documents');
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
        Schema::dropIfExists('document_patient');
    }
}
