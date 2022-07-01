<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agunan extends Model
{
    use HasFactory;

    protected $table = "agunan_nasabah";

    protected $fillable = [
        "jenisagunan" ,
        "id_debitur"  ,
        "jenis_kepemilikan" ,
        "no_pemilik"   ,
        "nama_pemilik" ,
        "IMB"          ,
        "luas_tanah_bangunan",
        "jatuh_tempo_shgb",
        "lokasi"       ,
        "nilai_taksasi",
        "deskripsi",
        "jenis_kendaraan",
        "merk"          ,
        "tahun"         ,
        "no_mesin"      ,
        "no_rangka"     ,
        "no_bpkb"       ,
        "no_polisi"     ,
        "pemilikmotor"    ,
        "jaminan"       ,
        "alamat"    ,
    ];

}
