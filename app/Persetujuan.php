<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persetujuan extends Model
{
    //
    protected $table = 'persetujuan';
    protected $primaryKey = 'Kode_Persetujuan';
    protected $fillable = [
        'UMKM_Kode',
        'Tanggal_Persetujuan'
    ];
}
