<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systemsettings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('fevicon')->nullable();
            $table->string('powerby')->nullable();
            $table->string('app_name')->nullable();
            $table->string('copyright')->nullable();

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
        Schema::dropIfExists('systemsettings');
    }
}