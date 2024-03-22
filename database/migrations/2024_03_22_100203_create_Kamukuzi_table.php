<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKamukuziTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Kamukuzi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('VHT_Name')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Gender')->nullable();
            $table->string('DOB')->nullable();
            $table->string('Health_facility_attached')->nullable();
            $table->string('Level_of_Education')->nullable();
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
        Schema::dropIfExists('Kamukuzi');
    }
}
