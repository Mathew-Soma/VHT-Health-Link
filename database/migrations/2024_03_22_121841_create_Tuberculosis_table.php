<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTuberculosisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tuberculosis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name')->nullable();
            $table->string('Phone')->nullable();
            $table->string('TB_Status')->nullable();
            $table->string('PatientID')->nullable();
            $table->string('District')->nullable();
            $table->string('SubCounty')->nullable();
            $table->string('Village')->nullable();
            $table->string('Last_Hospital_Visit')->nullable();
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
        Schema::dropIfExists('Tuberculosis');
    }
}
