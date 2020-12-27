<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisTransaksi extends Model
{
    protected $fillable = [
        'nm_transaksi','jenis_transaksi','status_jenis_transaksi','slug'
    ];
}
