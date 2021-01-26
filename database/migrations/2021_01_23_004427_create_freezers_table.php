<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreezersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freezers', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('brand',50);
            $table->integer('capacity');
            $table->string('obs');
            $table->integer('cant_racks');
            $table->integer('cant_box');
            $table->integer('cap_box');
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
        Schema::dropIfExists('freezers');
    }
}
