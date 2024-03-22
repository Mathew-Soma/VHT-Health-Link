<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseaseCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Disease_Cases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Case')->nullable();
            $table->date('Date')->nullable();
            $table->string('Number')->nullable();
            $table->string('District')->nullable();
            $table->string('Subcounty')->nullable();
            $table->string('Parish')->nullable();
            $table->string('Village')->nullable();
            $table->string('Risk')->nullable();
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
        Schema::dropIfExists('Disease_Cases');
    }
}
