<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'jenis_transaksi_id','anggota_id','user_id','jumlah_transaksi','tanggal_transaksi','bulan_transaksi','tahun_transaksi','jenis_transaksi','keterangan'
    ];
}
