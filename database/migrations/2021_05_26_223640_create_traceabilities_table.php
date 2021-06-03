<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraceabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traceabilities', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->unsignedBigInteger('sample_id');
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->unsignedBigInteger('tube_id')->nullable();
            $table->string('body')->nullable();
            $table->longText('obs')->nullable();
            $table->timestamps();

            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('cascade');
            $table->foreign('tube_id')->references('id')->on('tubes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traceabilities');
    }
}
