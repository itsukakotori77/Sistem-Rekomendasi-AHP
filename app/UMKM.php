<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UMKM extends Model
{
    // Table
    protected $table = 'umkm';
    protected $primaryKey = 'Kode_Umkm';
    protected $fillable = [
        'Nama_Usaha',
        'Nama_Pemilik_Usaha',
        'Sektor_Usaha',
        'Komoditi',
        'Alamat_Jalan',
        'Kecamatan',
        'Desa',
        'KTP',
        'NPWP',
        'Email',
        'Tahun_Mulai',
        'No_Telp',
        'Status',
        'Foto',
        'Dokumen',
        'User_ID',
    ];

    // Function
    public function aset()
    {
        return $this->hasOne(Aset::class, 'UMKM_Kode');
    }
}
