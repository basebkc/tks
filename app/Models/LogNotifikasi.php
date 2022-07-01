<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogNotifikasi extends Model
{
    use HasFactory;

    protected $table = "log_notifikasi";

    protected $fillable = [
        'no_rekening',
        'jenis_notif',
        'nominal',
        'jam_trans',
        'status_terkirim',
        'kode_trans',
        'tabtrans_id'
    ];
}
