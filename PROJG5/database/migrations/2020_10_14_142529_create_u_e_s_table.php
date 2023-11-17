<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUESTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_e_s', function (Blueprint $table) {
            $table->string('UE',25)->primary();
            $table->integer('ECTS')->unsigned();
            $table->integer('heures')->unsigned();
        });

        DB::statement('ALTER TABLE u_e_s ADD CONSTRAINT checkEcts CHECK(ECTS > 0);');
        DB::statement('ALTER TABLE u_e_s ADD CONSTRAINT checkHeures CHECK(heures > 0);');

        DB::table('u_e_s')->insert([
            ['UE'=> 'CAI1','ECTS'=> 2,'heures'=> 24],
            ['UE'=> 'CPT1','ECTS'=> 2,'heures'=> 24],
            ['UE'=> 'DEV1','ECTS'=> 10,'heures'=> 114],
            ['UE'=> 'INT1','ECTS'=> 10,'heures'=> 108],
            ['UE'=> 'MAT1','ECTS'=> 6,'heures'=> 72],
            ['UE'=> 'ANA2','ECTS'=> 6,'heures'=> 72],
            ['UE'=> 'ALG2','ECTS'=> 6,'heures'=> 72],
            ['UE'=> 'CAI2','ECTS'=> 2,'heures'=> 24],
            ['UE'=> 'DEV2','ECTS'=> 10,'heures'=> 108],
            ['UE'=> 'DON2','ECTS'=> 5,'heures'=> 48],
            ['UE'=> 'MIC2','ECTS'=> 6,'heures'=> 72],
            ['UE'=> 'STA2','ECTS'=> 3,'heures'=> 48],
            ['UE'=> 'SYS2','ECTS'=> 5,'heures'=> 60],
            ['UE'=> 'WEBG2','ECTS'=> 5,'heures'=> 60],
            ['UE'=> 'ALG3','ECTS'=> 4,'heures'=> 48],
            ['UE'=> 'ANA3','ECTS'=> 5,'heures'=> 72],
            ['UE'=> 'ATLG3','ECTS'=> 5,'heures'=> 48],
            ['UE'=> 'CAIG3','ECTS'=> 3,'heures'=> 48],
            ['UE'=> 'DEV3','ECTS'=> 6,'heures'=> 72],
            ['UE'=> 'DON3','ECTS'=> 5,'heures'=> 48],
            ['UE'=> 'DRTG3','ECTS'=> 2,'heures'=> 24],
            ['UE'=> 'ATLG4','ECTS'=> 4,'heures'=> 48],
            ['UE'=> 'CPRG4','ECTS'=> 6,'heures'=> 72],
            ['UE'=> 'CPTG4','ECTS'=> 2,'heures'=> 24],
            ['UE'=> 'DEV4','ECTS'=> 2,'heures'=> 24],
            ['UE'=> 'DON4','ECTS'=> 5,'heures'=> 48],
            ['UE'=> 'ECOG4','ECTS'=> 3,'heures'=> 36],
            ['UE'=> 'ERGG4','ECTS'=> 6,'heures'=> 72],
            ['UE'=> 'LPDG4','ECTS'=> 6,'heures'=> 72],
            ['UE'=> 'SECG4','ECTS'=> 5,'heures'=> 60],
            ['UE'=> 'SYSG4','ECTS'=> 5,'heures'=> 72],
            ['UE'=> 'WEBG4','ECTS'=> 4,'heures'=> 48],
            ['UE'=> 'DONG5','ECTS'=> 2,'heures'=> 24],
            ['UE'=> 'ERPG5','ECTS'=> 5,'heures'=> 48],
            ['UE'=> 'MOBG5','ECTS'=> 5,'heures'=> 48],
            ['UE'=> 'ORGG5','ECTS'=> 2,'heures'=> 36],
            ['UE'=> 'PRJG5','ECTS'=> 6,'heures'=> 72],
            ['UE'=> 'SYSG5','ECTS'=> 4,'heures'=> 36],
            ['UE'=> 'TEX5','ECTS'=> 2,'heures'=> 48],
            ['UE'=> 'VEI5', 'ECTS'=> 1,'heures'=> 24],
            ['UE'=> 'WEBG5','ECTS'=> 3,'heures'=> 48],
            ['UE'=> 'ETE6','ECTS'=> 30,'heures'=> 350],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('u_e_s');
    }
}
