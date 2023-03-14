<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHitlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hitlogs', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->nullable();
            $table->string('view')->nullable();
            $table->string('browser')->nullable();
            $table->string('link')->nullable();
            $table->string('spent_time')->nullable();
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
        Schema::dropIfExists('hitlogs');
    }
}
