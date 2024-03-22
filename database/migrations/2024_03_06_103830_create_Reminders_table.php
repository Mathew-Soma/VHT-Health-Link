<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Reciepient')->nullable();
            $table->string('Message')->nullable();
            $table->string('DeliveryStatus')->nullable();
            $table->time('Time')->nullable();
            $table->date('Date')->nullable();
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
        Schema::dropIfExists('Reminders');
    }
}
