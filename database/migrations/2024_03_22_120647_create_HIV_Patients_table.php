<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHIVPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HIV_Patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Gender')->nullable();
            $table->string('PatientID')->nullable();
            $table->date('DOB')->nullable();
            $table->string('District')->nullable();
            $table->string('Subcounty')->nullable();
            $table->string('Village')->nullable();
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
        Schema::dropIfExists('HIV_Patients');
    }
}
