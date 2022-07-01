<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ldr extends Model
{
    use HasFactory;
    protected $table = 'tks_ldr_mapp';
    protected $fillable = [
        'kode',
        'nama_perkiraan',
        'kode_perk',
        'cara_hitung'
    ];

}
