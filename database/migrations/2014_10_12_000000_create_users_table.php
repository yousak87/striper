<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_lengkap');
            $table->string('nrp');
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('status_karyawan');
            $table->string('jenis_karyawan');
            $table->string('level');
            $table->string('gambar');
            $table->rememberToken();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
