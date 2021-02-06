<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmkmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umkm', function (Blueprint $table) {
            $table->id('Kode_Umkm');
            $table->string('Nama_Usaha');
            $table->string('Nama_Pemilik_Usaha');
            $table->integer('Sektor_Usaha');
            $table->string('Komoditi');
            $table->string('Alamat_Jalan');
            $table->integer('Alamat_Kecamatan'); //API
            $table->integer('Desa'); //API
            $table->string('KTP'); 
            $table->string('NPWP'); 
            $table->string('Email')->unique();
            $table->date('Tanggal_Mulai');
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
        Schema::dropIfExists('umkm');
    }
}
