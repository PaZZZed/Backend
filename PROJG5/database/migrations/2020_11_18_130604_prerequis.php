<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prerequis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prerequis', function (Blueprint $table) {
            $table->primary(["ue_id", "prerequis"]);
            $table->string('ue_id',25);
            $table->string('prerequis',25);

            $table->foreign("ue_id")
                ->references("UE")
                ->on("u_e_s");

            $table->foreign("prerequis")
                ->references("UE")
                ->on("u_e_s");
        });

        

        DB::table('prerequis')->insert([
            ['ue_id'=> 'ANA3','prerequis'=> 'ANA2'],
            ['ue_id'=> 'DEV3','prerequis'=> 'ANA2'],
            ['ue_id'=> 'DEV3','prerequis'=> 'ALG2'],
            ['ue_id'=> 'DEV3','prerequis'=> 'DEV2'],
            ['ue_id'=> 'DON3','prerequis'=> 'DON2'],
            ['ue_id'=> 'ALG3','prerequis'=> 'ALG2'],
            ['ue_id'=> 'ATLG3','prerequis'=> 'ANA2'],
            ['ue_id'=> 'ATLG3','prerequis'=> 'ALG2'],
            ['ue_id'=> 'ATLG3','prerequis'=> 'DEV2'],
            ['ue_id'=> 'DON4','prerequis'=> 'DON3'],
            ['ue_id'=> 'DEV4','prerequis'=> 'DEV3'],
            ['ue_id'=> 'SYSG4','prerequis'=> 'SYS2'],
            ['ue_id'=> 'SYSG4','prerequis'=> 'DEV3'],
            ['ue_id'=> 'WEBG4','prerequis'=> 'WEBG2'],
            ['ue_id'=> 'LPDG4','prerequis'=> 'DON4'],
            ['ue_id'=> 'ATLG4','prerequis'=> 'ATLG3'],
            ['ue_id'=> 'ECOG4','prerequis'=> 'CPT1'],
            ['ue_id'=> 'ERGG4','prerequis'=> 'DEV2'],
            ['ue_id'=> 'ERGG4','prerequis'=> 'WEBG2'],
            ['ue_id'=> 'TEX5','prerequis'=> 'ETE6'],
            ['ue_id'=> 'PRJG5','prerequis'=> 'ANA3'],
            ['ue_id'=> 'PRJG5','prerequis'=> 'DEV3'],
            ['ue_id'=> 'PRJG5','prerequis'=> 'ATLG3'],
            ['ue_id'=> 'MOBG5','prerequis'=> 'ATLG4'],
            ['ue_id'=> 'WEBG5','prerequis'=> 'WEBG4'],
            ['ue_id'=> 'ORGG5','prerequis'=> 'CPTG4'],
            ['ue_id'=> 'ORGG5','prerequis'=> 'ECOG4'],
            ['ue_id'=> 'ERPG5','prerequis'=> 'WEBG4'],
            ['ue_id'=> 'SYSG5','prerequis'=> 'SYSG4'],
            ['ue_id'=> 'SYSG5','prerequis'=> 'SECG4'],
            ['ue_id'=> 'ETE6','prerequis'=> 'TEX5'],
            ['ue_id'=> 'ETE6','prerequis'=> 'VEI5'],
            ['ue_id'=> 'ETE6','prerequis'=> 'PRJG5'],
            ['ue_id'=> 'ETE6','prerequis'=> 'MOBG5'],
            ['ue_id'=> 'ETE6','prerequis'=> 'WEBG5'],
            ['ue_id'=> 'ETE6','prerequis'=> 'DONG5'],
            ['ue_id'=> 'ETE6','prerequis'=> 'ORGG5'],
            ['ue_id'=> 'ETE6','prerequis'=> 'ERPG5'],
            ['ue_id'=> 'ETE6','prerequis'=> 'SYSG5'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prerequis');
    }
}
