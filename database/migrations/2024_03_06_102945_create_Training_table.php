<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Training', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Topic')->nullable();
            $table->string('Trainer')->nullable();
            $table->date('Date')->nullable();
            $table->string('Period')->nullable();
            $table->string('Venue')->nullable();
            $table->time('Time')->nullable();
            $table->string('Status')->nullable();
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
        Schema::dropIfExists('Training');
    }
}
