<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactories;

class Pembayaran extends Model
{
    protected $fillable = [
        'NISN',
        'Tanggal',
        'Jenis_pembayaran',
        'Jumlah',
    ];
}
