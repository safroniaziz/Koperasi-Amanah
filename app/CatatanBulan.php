<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatatanBulan extends Model
{
    protected $fillable = [
        'tahun','bulan','modal_awal'
    ];
}
