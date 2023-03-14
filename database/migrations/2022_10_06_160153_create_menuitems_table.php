<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menuitems', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->string('name_en')->nullable();
            $table->string('slug_en')->nullable();   
            
            $table->string('title_bn')->nullable();
            $table->string('name_bn')->nullable();
            $table->string('slug_bn')->nullable();



            $table->string('type')->nullable();
            $table->string('target')->nullable();
            $table->integer('menu_id')->nullable();
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
        Schema::dropIfExists('menuitems');
    }
}
