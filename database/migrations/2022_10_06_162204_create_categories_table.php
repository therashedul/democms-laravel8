<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->string('name_en')->nullable();
            $table->string('slug_en')->unique();      
            
            $table->string('title_bn')->nullable();
            $table->string('name_bn')->nullable();
            $table->string('slug_bn')->unique();
            $table->string('link')->nullable();     
            $table->integer('parent_id')->default('0');;
            $table->string('category_img')->nullable();
            $table->boolean('status')->default('1');
            $table->boolean('privatecat')->default('0');

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
        Schema::dropIfExists('categories');
    }
}
