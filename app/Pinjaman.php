<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $fillable = [
        'anggota_id',
        'user_id',
        'jumlah_pinjaman',
        'bunga',
        'jumlah_angsuran_pokok',
        'jumlah_angsuran_bunga',
        'bulan_mulai_angsuran',
        'tahun_mulai_angsuran',
        'bulan_akhir_angsuran',
        'tahun_akhir_angsuran',
        'status_pinjaman',
        'jumlah_bulan',
    ];
}
