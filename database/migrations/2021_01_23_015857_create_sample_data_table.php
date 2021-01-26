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
            $table->char('trat_q',1);
            $table->date('trat_q_date');
            $table->string('trat_q_criterio');
            $table->string('trat_q_plan',30);
            $table->char('radio_t',1);
            $table->date('radio_t_date');
            $table->string('radio_t_criterio');
            $table->string('radio_t_plan',30);
            $table->char('quimio',1);
            $table->date('quimio_date');
            $table->string('quimio_criterio');
            $table->string('quimio_plan',30);
            $table->char('homo',1);
            $table->date('homo_date');
            $table->string('homo_criterio');
            $table->string('homo_plan',30);
            $table->char('terapia_bio',1);
            $table->date('terapia_bio_date');
            $table->string('terapia_bio_criterio');
            $table->string('terapia_bio_plan',30);
            $table->char('otros',1);
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
