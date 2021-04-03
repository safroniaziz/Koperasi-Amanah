<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Anggota extends Authenticatable
{
    use Notifiable;

    protected $guard = 'anggota';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nm_anggota', 'nik', 'alamat','tahun_keanggotaan','status_anggota','email','password','gambar','jabatan_id','simpanan_pokok'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
