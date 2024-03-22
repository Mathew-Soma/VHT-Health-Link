<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthInspectorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HealthInspector', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Email')->nullable();
            $table->string('District')->nullable();
            $table->string('Parish')->nullable();
            $table->string('Village')->nullable();
            $table->string('Bio')->nullable();
            $table->string('HealthInspectorNumber')->unique()->nullable();
            $table->date('DOB')->nullable();
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
        Schema::dropIfExists('HealthInspector');
    }
}
