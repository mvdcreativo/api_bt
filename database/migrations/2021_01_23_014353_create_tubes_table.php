<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTubesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tubes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sample_id');
            $table->string('code');
            $table->string('volume');
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
        Schema::dropIfExists('tubes');
    }
}
