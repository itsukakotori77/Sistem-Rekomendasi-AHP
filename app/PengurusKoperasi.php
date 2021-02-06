<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengurusKoperasi extends Model
{
    //
    protected $table = 'pengurus_koperasi';
    protected $primaryKey = 'Kode_Pengurus';
    protected $fillable = [
        'Nama_Depan',
        'Nama_Belakang',
        'Jenis_Kelamin',
        'Alamat',
        'Foto',
        'User_ID',
    ];
}
