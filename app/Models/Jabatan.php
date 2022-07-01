<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'tbl_jabatan';
    protected $fillable = [
        'id_jab',
        'kode',
        'n_jab',
        'gapok',
        'tunj_jab',
        'm_kerja',
    ];

    public function mutasi(){
        return $this->belongsTo(Mutasi::class);
    }
}
