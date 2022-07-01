<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'cabang' ,
        'PIC_cabang',
        'kendala',
        'status',
        'keterangan' ,
        'kontak' ,
        'remote' ,
        'kategori' ,
        'lampiran',
        'sifat' ,
        'PIC_IT' ,
        'created_at',
        'nopengajuantugas',
        'tanggal_selesai'
    ];
    
}
