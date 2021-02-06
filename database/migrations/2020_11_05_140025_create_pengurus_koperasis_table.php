<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengurusKoperasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengurus_koperasi', function (Blueprint $table) {
            $table->id('Kode_Pengurus');
            $table->string('Nama_Depan');
            $table->string('Nama_Belakang');
            $table->integer('Jenis_Kelamin');
            $table->integer('Status');
            $table->string('Foto');
            $table->integer('User_ID');
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
        Schema::dropIfExists('pengurus_koperasi');
    }
}
