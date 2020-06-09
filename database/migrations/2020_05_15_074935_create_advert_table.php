<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('company_id');
            $table->boolean('office');
            $table->boolean('home');
            $table->integer('city_id');
            $table->integer('minsallary');
            $table->bigInteger('maxsallary');
            $table->text('description');
            $table->json('technology');
            $table->string('skills');
            $table->boolean('block')->default('false');

            $table->foreign('company_id')->references('id')->on('company');
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
        Schema::dropIfExists('advert');
    }
}
