<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    use HasFactory;
    protected $table = 'tbl_kantor';

    public function mutasis(){
        return $this->hasMany(Mutasi::class);
    }

    public function users(){
        return $this->belongsTo(User::class, 'kode_kantor', 'kd_kan');
    }
}   
