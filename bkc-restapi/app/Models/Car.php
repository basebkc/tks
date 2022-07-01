<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cr extends Model
{
    use HasFactory;
    protected $table = 'tks_car_mapp';
    protected $fillable = [
        'kode',
        'nama_perkiraan',
        'kode_perk',
        'cara_hitung'
        
    ];

}
