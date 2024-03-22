<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpectantMothersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expectant_mothers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name')->nullable();
            $table->string('Phone')->nullable();
            $table->string('PatientID')->nullable();
            $table->string('Antenantal_care_visits')->nullable();
            $table->string('DOB')->nullable();
            $table->string('Complications')->nullable();
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
        Schema::dropIfExists('expectant_mothers');
    }
}
