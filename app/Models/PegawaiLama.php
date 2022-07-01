<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiLama extends Model
{
    use HasFactory;

    protected $connection   = 'mysql2';
    protected $table        = 'pegawai';
    protected $fillable     = ['id_jab'];

}
