<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JumlahKeseluruhan extends Model
{
    protected $fillable = [
        'jumlah_simpanan_seluruh','jumlah_jasa_seluruh','jumlah_transaksi_seluruh'
    ];
}
