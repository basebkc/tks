<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahBaru extends Model
{
    use HasFactory;

    protected $table = "nasabah_barus";

    protected $fillable = [ 
                    'namalengkap',
                    'produk',
                    'nik',
                    'nohp',
                    'email',
                    'alamat',
                    'alamatdomisili',
                    'pekerjaan',
                    'cabang',
                    'pathktp',
                    'pathkk',
                    'pathnpwp'
                ];

    public function kantors(){
        return $this->belongsTo(Kantor::class);
    }

}
