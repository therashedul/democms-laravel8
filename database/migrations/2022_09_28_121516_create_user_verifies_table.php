<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVerifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_verifies', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('token')->nullable();
            $table->timestamps();
        });

        //belowe code  use only first time otherways comment  
        
        // Schema::table('users', function (Blueprint $table) {
        //     $table->boolean('is_email_verified')->default(0);
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_verifies');
    }
}
