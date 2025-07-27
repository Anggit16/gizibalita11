<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'umur',
        'berat',
        'tinggi',
        'status_gizi'
    ];
}
