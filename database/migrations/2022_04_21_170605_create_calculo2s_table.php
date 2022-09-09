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
        Schema::create('calculo2s', function (Blueprint $table) {
            $table->id();
            $table->integer('renovation_id');
            $table->integer('year');
            $table->float('kwh_before')->default(0);
            $table->float('kwh_after')->default(0);
            $table->float('kwh_eco')->default(0);
            $table->float('co2_before')->default(0);
            $table->float('co2_after')->default(0);
            $table->float('co2_eco')->default(0);
            $table->float('m2')->default(0);
            $table->float('kwh_m2')->default(0);
            $table->float('co2_m2')->default(0);
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
        Schema::dropIfExists('calculo2s');
    }
};
