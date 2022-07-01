<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarNasabahNotif extends Model
{
    use HasFactory;

    // protected $connection = 'mysql';

    protected $table = 'daftar_nasabah_notif';



    protected $fillable = [
        'id',
        'kode_kantor',
        'no_rekening',
        'no_hp',
        'no_wa',
        'status_wa',
        'status_sms',
        'keterangan',
        'status',
        'tgl_aktif',
        'tgl_akhir'
    ];

}
