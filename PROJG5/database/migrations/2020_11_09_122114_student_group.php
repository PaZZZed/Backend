<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StudentGroup', function (Blueprint $table) {
            $table->string("group_id",5);
            $table->integer("number_id")->unsigned();
            $table->primary(["group_id","number_id"]);

            $table->foreign("group_id")
                ->references("group")
                ->on("Group");

            $table->foreign("number_id")
                ->references("numbers")
                ->on("Student");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('StudentGroup');
    }
}
