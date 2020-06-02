<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->float('score')->nullable();
            $table->string('img');
            $table->integer('city_id');
            $table->boolean('office')->nullable();
            $table->boolean('home')->nullable();
            $table->integer('workers')->nullable();
            $table->text('description');
            $table->json('technology');
            $table->string('token')->nullable();

            $table->foreign('city_id')->references('id')->on('city');


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
        Schema::dropIfExists('company');
    }
}
