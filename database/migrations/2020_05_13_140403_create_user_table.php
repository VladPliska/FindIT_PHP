<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->integer('phone');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->integer('experience')->nullable();
            $table->integer('sallary')->nullable();
            $table->boolean('office')->nullable();
            $table->boolean('home')->nullable();
            $table->json('technology');
            $table->json('selectadvert')->nullable();
            $table->string('role');
            $table->text('resume')->nullable();
            $table->string('token');
            $table->string('img')->nullable();

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
        Schema::dropIfExists('user');
    }
}
