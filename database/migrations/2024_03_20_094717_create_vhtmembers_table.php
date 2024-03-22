<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVhtmembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vhtmembers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Gender')->nullable();
            $table->string('DOB')->nullable();
            $table->string('District')->nullable();
            $table->string('SubCounty')->nullable();
            $table->string('Parish')->nullable();
            $table->string('Village')->nullable();
            $table->string('Health_facility_attached')->nullable();
            $table->string('vhtnumber')->nullable();
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
        Schema::dropIfExists('vhtmembers');
    }
}
