<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('company_id');
            $table->string('fullname');
            $table->string('email');
            $table->integer('phone');
            $table->integer('sallary');
            $table->text('resume');
            $table->integer('advert_id');
            $table->string('status')->nullable();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('company_id')->references('id')->on('company');
            $table->foreign('advert_id')->references('id')->on('advert');

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
        Schema::dropIfExists('answer');
    }
}
