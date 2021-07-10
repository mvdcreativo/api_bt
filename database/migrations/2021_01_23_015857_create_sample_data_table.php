<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sample_id');
            $table->boolean('trat_q')->nullable();
            $table->date('trat_q_date')->nullable();
            $table->string('trat_q_criterio')->nullable();
            $table->string('trat_q_plan',30)->nullable();
            $table->boolean('radio_t')->nullable();
            $table->date('radio_t_date')->nullable();
            $table->string('radio_t_criterio')->nullable();
            $table->string('radio_t_plan',30)->nullable();
            $table->boolean('quimio')->nullable();
            $table->date('quimio_date')->nullable();
            $table->string('quimio_criterio')->nullable();
            $table->string('quimio_plan',30)->nullable();
            $table->boolean('homo')->nullable();
            $table->date('homo_date')->nullable();
            $table->string('homo_criterio')->nullable();
            $table->string('homo_plan',30)->nullable();
            $table->boolean('terapia_bio')->nullable();
            $table->date('terapia_bio_date')->nullable();
            $table->string('terapia_bio_criterio')->nullable();
            $table->string('terapia_bio_plan',30)->nullable();
            $table->boolean('otros')->nullable();
            $table->date('otros_date')->nullable();
            $table->string('otros_criterio')->nullable();
            $table->string('otros_plan',30)->nullable();
            $table->timestamps();

            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sample_data');
    }
}
