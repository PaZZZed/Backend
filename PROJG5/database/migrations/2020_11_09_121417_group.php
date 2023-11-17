<?php

use App\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Group extends Migration
{
    /**
     * Run the migrations.
     *this method create a schema and set some constraint to the table Group
     * and make insert some data into table
     * @return void
     */
    public function up()
    {
        Schema::create('Group', function (Blueprint $table) {
            $table->string("group",5)->primary();
            $table->integer("bloc");

        });
        DB::table('Group')->insert([
            ['group' => 'C111', 'bloc' => 2],
            ['group' => 'C112', 'bloc' => 2],
            ['group' => 'C113', 'bloc' => 2],
            ['group' => 'C121', 'bloc' => 2],
            ['group' => 'C122', 'bloc' => 2],
            ['group' => 'C123', 'bloc' => 2],

            ['group' => 'E11', 'bloc' => 3],
            ['group' => 'E12', 'bloc' => 3],
            ['group' => 'E13', 'bloc' => 3],
            ['group' => 'E14', 'bloc' => 3]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Group');
    }
}
