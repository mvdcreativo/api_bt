<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleDataAnatomosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_data_anatomos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sample_id');
            $table->unsignedBigInteger('estadio_id')->nullable();
            $table->boolean('anatomia')->nullable();
            $table->date('anatomia_date')->nullable();
            $table->boolean('biopsia')->nullable();
            $table->boolean('reseccion_q')->nullable();
            $table->boolean('con_cancer')->nullable();
            $table->string('operacion')->nullable();
            $table->longText('obs')->nullable();
            $table->unsignedBigInteger('type_surgery_id')->nullable();
            $table->integer('isquemia_min')->nullable();
            $table->integer('isquemia_seg')->nullable();
            $table->integer('tacos_cant')->nullable();
            $table->integer('laminas_cant')->nullable();
            $table->integer('necrosis_tumoral_cant')->nullable();

            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
            $table->foreign('estadio_id')->references('id')->on('estadios')->onDelete('restrict');
            $table->foreign('type_surgery_id')->references('id')->on('type_surgeries')->onDelete('restrict');
            
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
        Schema::dropIfExists('sample_data_anatomos');
    }
}
