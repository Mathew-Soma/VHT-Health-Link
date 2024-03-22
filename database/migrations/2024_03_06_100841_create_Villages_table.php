<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Villages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name')->nullable();
            $table->string('District')->nullable();
            $table->string('Subcounty')->nullable();
            $table->string('Parish')->nullable();
            $table->string('Number_of_vhts')->nullable();
            $table->string('Health_facility_attached')->nullable();
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
        Schema::dropIfExists('Villages');
    }
}
