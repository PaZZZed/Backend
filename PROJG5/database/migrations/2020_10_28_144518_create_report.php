<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {

            $table->primary(['numbers', 'UE']);
            $table->UnsignedInteger('numbers');
            $table->string('UE');

            $table->boolean('acquired');

            $table->foreign('numbers')->references('numbers')->on('student')->onDelete('cascade');
            $table->foreign('UE')->references('UE')->on('u_e_s')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report');
    }

}
