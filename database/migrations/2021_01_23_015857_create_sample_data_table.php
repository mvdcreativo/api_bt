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
            $table->boolean('trat_q');
            $table->date('trat_q_date');
            $table->string('trat_q_criterio');
            $table->string('trat_q_plan',30);
            $table->boolean('radio_t');
            $table->date('radio_t_date');
            $table->string('radio_t_criterio');
            $table->string('radio_t_plan',30);
            $table->boolean('quimio');
            $table->date('quimio_date');
            $table->string('quimio_criterio');
            $table->string('quimio_plan',30);
            $table->boolean('homo');
            $table->date('homo_date');
            $table->string('homo_criterio');
            $table->string('homo_plan',30);
            $table->boolean('terapia_bio');
            $table->date('terapia_bio_date');
            $table->string('terapia_bio_criterio');
            $table->string('terapia_bio_plan',30);
            $table->boolean('otros');
            $table->date('otros_date');
            $table->string('otros_criterio');
            $table->string('otros_plan',30);
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
