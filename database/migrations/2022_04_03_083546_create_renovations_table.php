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
        Schema::create('renovations', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('label');
            $table->string('district')->nullable();
            $table->string('status');
            $table->integer('year');
            $table->integer('month');
            $table->string('purpose');
            $table->float('cost');
            $table->float('estimated_quantity');
            $table->string('unit_measure_quantity');
            $table->boolean('is_prime_eligible');
            $table->float('estimate_prime');
            $table->string('agencyName');
            $table->string('agencyAddress');
            $table->integer('agencyPostalCode');
            $table->integer('arrondissement_id')->default(0);
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
        Schema::dropIfExists('renovations');
    }
};
