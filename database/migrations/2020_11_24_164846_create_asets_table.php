<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aset', function (Blueprint $table) {
            $table->id('Kode_Aset');
            $table->integer('Jumlah_SDM');
            $table->integer('Total_Aset');
            $table->integer('Omzet');
            $table->integer('Sertifikat_Perizinan');
            $table->string('Wilayah_Pemasaran');
            $table->string('Keterangan');
            $table->integer('UMKM_Kode');
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
        Schema::dropIfExists('aset');
    }
}
