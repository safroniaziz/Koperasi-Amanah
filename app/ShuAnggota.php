<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShuAnggota extends Model
{
    protected $fillable = [
        'anggota_id','nm_anggota','jabatan','shu_simpanan','shu_jasa','jumlah','tahun'
    ];
}
