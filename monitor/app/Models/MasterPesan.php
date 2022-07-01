<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPesan extends Model
{
    use HasFactory;

    protected $connection = "mysql";

    protected $table = "master_pesan";

    // public function tabtrans(){
    //     return $this->hasMany(TabTransaksi::class,'KODE_TRANS','kode_trans');
    // }

    protected $fillable = [
        'id',
        'kode_trans',
        'keterangan',
        'isi_pesan'
    ];
}
