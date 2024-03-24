<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKiswahiliHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KiswahiliHospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Hospital_Name')->nullable();
            $table->string('N0_of_Vhts')->nullable();
            $table->string('Health_Inspector')->nullable();
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
        Schema::dropIfExists('KiswahiliHospitals');
    }
}
