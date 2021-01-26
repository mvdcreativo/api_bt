<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleStageUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_stage_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sample_id');
            $table->unsignedBigInteger('stage_id');
            $table->unsignedBigInteger('user_id');
            $table->longText('obs')->nullable();
            $table->timestamps();

            $table->foreign('sample_id')->references('id')->on('samples');
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sample_stage');
    }
}
