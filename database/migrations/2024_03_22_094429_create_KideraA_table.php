<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKideraATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KideraA', function (Blueprint $table) {
            $table->increments('id');
            $table->string('VHT_Name')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Gender')->nullable();
            $table->date('DOB')->nullable();
            $table->string('Health_attached')->nullable();
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
        Schema::dropIfExists('KideraA');
    }
}
