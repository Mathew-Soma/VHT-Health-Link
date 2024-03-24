<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKateteHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KateteHospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Hospital_Name')->nullable();
            $table->string('No_of_Vhts')->nullable();
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
        Schema::dropIfExists('KateteHospitals');
    }
}
