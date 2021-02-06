<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilPerhitungan extends Model
{
    //
    protected $table = 'hasil_perhitungan';
    protected $primaryKey = 'Kode_Hasil';
    protected $fillable = [
        'Kriteria_Kecocokan',
        'UMKM_Kode'
    ];

}
