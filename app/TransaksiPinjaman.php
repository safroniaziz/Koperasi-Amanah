<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPinjaman extends Model
{
    protected $fillable = [
        'transaksi_id','pinjaman_id'
    ];
}
