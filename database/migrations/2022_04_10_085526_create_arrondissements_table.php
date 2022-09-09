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
        Schema::create('arrondissements', function (Blueprint $table) {
            $table->id();
            $table->integer('ins');
            $table->string('entite');
            $table->decimal('latitude');
            $table->decimal('longitude');
            $table->json('geojson')->nullable();
            $table->string('shapeLength')->nullable();
            $table->string('shapeArea')->nullable();
            $table->integer('totBuild2016')->nullable();
            $table->integer('totBuild2017')->nullable();
            $table->integer('totBuild2018')->nullable();
            $table->integer('totBuild2019')->nullable();
            $table->integer('totBuild2020')->nullable();
            $table->integer('totBuild2021')->nullable();
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
        Schema::dropIfExists('arrondissements');
    }
};
