<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name')->nullable();
            $table->string('Patient_Number')->nullable();
            $table->string('Phone')->nullable();
            $table->string('DOB')->nullable();
            $table->string('District')->nullable();
            $table->string('SubCounty')->nullable();
            $table->string('Parish')->nullable();
            $table->string('Village')->nullable();
            $table->string('Condition')->nullable();
            $table->string('Current_State')->nullable();
            $table->string('Health_Facility')->nullable();
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
        Schema::dropIfExists('Patients');
    }
}
