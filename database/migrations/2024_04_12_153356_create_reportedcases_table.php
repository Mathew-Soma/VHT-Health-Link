<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportedcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportedcases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('DiseaseName')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Number_of_patients')->nullable();
            $table->string('VHT_Name')->nullable();
            $table->string('Date')->nullable();
            $table->string('District')->nullable();
            $table->string('Subcounty')->nullable();
            $table->string('Parish')->nullable();
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
        Schema::dropIfExists('reportedcases');
    }
}
