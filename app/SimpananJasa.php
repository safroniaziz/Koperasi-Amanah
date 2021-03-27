<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpananJasa extends Model
{
    protected $fillable = [
        'anggota_id','tahun','jumlah'
    ];
}
