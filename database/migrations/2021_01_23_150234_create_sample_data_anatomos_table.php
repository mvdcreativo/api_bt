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
            $table->unsignedBigInteger('estadio_id');
            $table->boolean('anatomia');
            $table->date('anatomia_date');
            $table->boolean('biopsia');
            $table->boolean('reseccion_q');
            $table->boolean('con_cancer');
            $table->unsignedBigInteger('type_surgery_id')->nullable();
            $table->integer('isquemia_min');
            $table->integer('isquemia_seg');
            $table->integer('tacos_cant');
            $table->integer('laminas_cant');
            $table->integer('necrosis_tumoral_cant');

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
