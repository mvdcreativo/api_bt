<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->string('code',20);
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('type_sample_id')->nullable();
            $table->unsignedBigInteger('tumor_lineage_id')->nullable();
            $table->unsignedBigInteger('tnm_id')->nullable();
            $table->unsignedBigInteger('topography_id')->nullable();


            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('type_sample_id')->references('id')->on('type_samples')->onDelete('restrict');
            $table->foreign('tumor_lineage_id')->references('id')->on('tumor_lineages')->onDelete('restrict');
            $table->foreign('tnm_id')->references('id')->on('tnms')->onDelete('restrict');
            $table->foreign('topography_id')->references('id')->on('topographies')->onDelete('restrict');
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
        Schema::dropIfExists('samples');
    }
}
