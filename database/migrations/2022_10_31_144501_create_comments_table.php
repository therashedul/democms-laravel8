<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('post_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->text('comment_body');
            $table->string('commentname')->nullable();
            $table->string('commentemail')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->softDeletes();
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
        Schema::dropIfExists('comments');
        
    }
}
