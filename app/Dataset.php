<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    //
    protected $table = 'dataset';
    protected $primaryKey = 'id';
    protected $fillable = [
        'KTP',
        'Usia',
        'Jumlah_Karyawan',
        'Aset',
        'Omzet',
        'Sium',
        'UMKM_ID'
    ];
    
}
