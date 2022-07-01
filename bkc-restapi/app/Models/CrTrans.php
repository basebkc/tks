<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrTrans extends Model
{
    use HasFactory;
    protected $table = 'tks_cr_trans';
    protected $fillable = [
        'kode',
        'nama_perkiraan',
        'kode_perk',
        'jumlah',
        'cara_hitung',
        'tgl_trans',
        'tgl_hitung',
        'kode_kantor'
    ];

}
