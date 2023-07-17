<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class spp extends Model
{
    protected $fillable = [
        'nominal',
        'tahun',
        'keterangan',
    ];
}

