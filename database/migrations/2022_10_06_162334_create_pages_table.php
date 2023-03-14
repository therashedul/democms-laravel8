<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en')->nullable();
            $table->string('name_en')->nullable();
            $table->string('slug_en')->unique()->nullable();
            $table->text('content_en')->nullable();    
            
            
            $table->string('title_bn')->nullable();
            $table->string('name_bn')->nullable();
            $table->string('slug_bn')->unique()->nullable();
            $table->text('content_bn')->nullable();
            
            $table->string('link')->unique()->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('video')->nullable();
            $table->string('template')->nullable();
            $table->boolean('status')->default('1');
            $table->boolean('privatepage')->default('0');
            $table->string('publish_at')->nullable();
            $table->string('views')->default('0');
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
        Schema::dropIfExists('pages');
    }
}
