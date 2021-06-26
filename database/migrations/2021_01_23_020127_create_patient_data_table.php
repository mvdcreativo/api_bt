<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->date('date_surgery')->nullable();
            $table->unsignedBigInteger('topography_id')->nullable();
            $table->unsignedBigInteger('type_surgery_id')->nullable();

            $table->boolean('imc');
            $table->float('imc_talla')->nullable();
            $table->float('imc_peso')->nullable();
            $table->float('imc_imc')->nullable();

            $table->boolean('fumador');
            $table->boolean('fumador_activo')->nullable();
            $table->string('fumador_cant')->nullable();

            $table->boolean('alcoholista');
            $table->boolean('alcoholista_activo')->nullable();
            $table->string('alcoholista_cant')->nullable();       

            $table->boolean('drogas');
            $table->boolean('drogas_activo')->nullable();
            $table->string('drogas_tipo',30)->nullable();       
            
            $table->boolean('rt');
            $table->string('rt_donde', 30)->nullable();
            $table->date('rt_date')->nullable();

            $table->boolean('anticonceptivos');
            $table->string('anticonceptivos_periodo')->nullable();

            $table->boolean('amamantar');
            $table->string('amamantar_periodo')->nullable();

            $table->boolean('hormonas');
            $table->string('hormonas_periodo')->nullable();
            
            $table->boolean('ambientales');
            $table->string('ambientales_cuales',50)->nullable();

            $table->boolean('mamografia');
            $table->string('mamografia_frecuencia')->nullable();
            $table->string('mamografia_otros')->nullable();
            $table->date('mamografia_date_ultima')->nullable();

            $table->boolean('pap');
            $table->string('pap_frecuencia')->nullable();
            $table->string('pap_otros')->nullable();
            $table->date('pap_date_ultima')->nullable();

            $table->tinyInteger('edad_menarca')->nullable();
            $table->tinyInteger('edad_primer_emb')->nullable();
            $table->tinyInteger('menopausia_edad')->nullable();
            $table->boolean('menopausia_quirurgica')->nullable();
            $table->boolean('antecedente');
            $table->boolean('antecedente_directo')->nullable();
            $table->string('antecedente_directo_tipo')->nullable();
            $table->boolean('antecedente_indirectos')->nullable();
            $table->string('antecedente_indirectos_tipo')->nullable();
            $table->boolean('anterior');
            $table->unsignedBigInteger('anterior_topography_id')->nullable();
            $table->integer('anterior_edad')->nullable();


            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('topography_id')->references('id')->on('topographies')->onDelete('cascade');
            $table->foreign('anterior_topography_id')->references('id')->on('topographies')->onDelete('cascade');
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
        Schema::dropIfExists('patient_data');
    }
}
