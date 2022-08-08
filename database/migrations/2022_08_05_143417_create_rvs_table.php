<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rvs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medecins_id')->unsigned();
            $table->foreign('medecins_id')->references('id')->on('medecins');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('libelle');
            $table->date('date');
            $table->integer('patients_id')->unsigned();
            $table->foreign('patients_id')->references('id')->on('patients');
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
        Schema::dropIfExists('rvs');
    }
};