<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    //
    protected $table = 'aset';
    protected $primaryKey = 'Kode_Aset';
    protected $fillable = [
        'Jumlah_SDM',
        'Total_Aset',
        'Omzet',
        'Sertifikat_Perizinan',
        'Wilayah_Pemasaran',
        'Keterangan',
        'UMKM_Kode',
    ];

    // Function
    public function aset()
    {
        return $this->belongsTo(UMKM::class, 'Kode_Umkm');
    }
}
