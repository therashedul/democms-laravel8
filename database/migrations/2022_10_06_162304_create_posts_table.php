<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en')->nullable();
            $table->string('name_en')->nullable();
            $table->string('slug_en')->unique()->nullable();
            $table->text('excerpt_en')->nullable();
            $table->text('content_en')->nullable();   
            $table->text('meta_description_en')->nullable();
            $table->text('meta_keywords_en')->nullable(); 
            
            
            $table->string('title_bn')->nullable();
            $table->string('name_bn')->nullable();
            $table->string('slug_bn')->unique()->nullable();
            $table->text('excerpt_bn')->nullable();
            $table->text('content_bn')->nullable();
            $table->text('meta_description_bn')->nullable();
            $table->text('meta_keywords_bn')->nullable();
            
            
            $table->string('tag')->nullable();
        
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('video')->nullable();
            $table->string('link')->unique()->nullable();
            $table->boolean('status')->default('1');
            $table->boolean('slider')->default('0');
            $table->boolean('trending')->default('1');
            $table->string('template')->nullable();
            $table->string('publish_at')->nullable();
            $table->integer('views')->default('0');
            $table->boolean('privateshow')->default('0');
            $table->softDeletes();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('posts');
    }
}
