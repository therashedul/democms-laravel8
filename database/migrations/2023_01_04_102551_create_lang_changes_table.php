<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLangChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lang_changes', function (Blueprint $table) {
            $table->id();
            $table->string('deshboard_en')->nullable();
            $table->string('about_en')->nullable();
            $table->string('categories_en')->nullable();
            $table->string('comment_en')->nullable();      
            $table->string('popular_en')->nullable();      
            $table->string('trending_en')->nullable();      
            $table->string('latest_en')->nullable();      
            $table->string('reletive_en')->nullable();      
            $table->string('more_en')->nullable();       
            $table->string('tags_en')->nullable();      
            $table->string('sidebar_en')->nullable();      
            $table->string('footer_en')->nullable();       
            $table->string('download_en')->nullable();       
            $table->string('subscriber_en')->nullable();       
            
            
            $table->string('deshboard_bn')->nullable();
            $table->string('about_bn')->nullable();
            $table->string('categories_bn')->nullable();
            $table->string('comment_bn')->nullable();      
            $table->string('popular_bn')->nullable();      
            $table->string('trending_bn')->nullable();      
            $table->string('latest_bn')->nullable();      
            $table->string('reletive_bn')->nullable();      
            $table->string('more_bn')->nullable();      
            $table->string('tags_bn')->nullable();      
            $table->string('sidebar_bn')->nullable();      
            $table->string('footer_bn')->nullable();      
            $table->string('download_bn')->nullable();      
            $table->string('subscriber_bn')->nullable();      
            
           
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
        Schema::dropIfExists('lang_changes');
    }
}
