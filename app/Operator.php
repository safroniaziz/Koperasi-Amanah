<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Operator extends Authenticatable
{
    use Notifiable;

    protected $guard = 'operator';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nm_operator', 'email', 'password','jabatan_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
