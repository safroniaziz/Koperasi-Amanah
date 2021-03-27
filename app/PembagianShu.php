<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembagianShu extends Model
{
    protected $fillable =[
        'tahun','persentase_simpanan','persentase_jasa','shu_tahun_berjalan','shu_simpanan','shu_jasa_pinjaman'
    ];
}
