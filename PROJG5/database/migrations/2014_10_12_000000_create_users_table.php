<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('status');


            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('numbers');
            $table->rememberToken();
            $table->timestamps();

        });
        DB::table('users')->insert([
            ['name' => 'admin', 'surname' => 'admin', 'status' => 'Administrateur/trice', 'email' => 'admin@admin.admin', 'password' => bcrypt("admin"), 'numbers' => 00001],
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
