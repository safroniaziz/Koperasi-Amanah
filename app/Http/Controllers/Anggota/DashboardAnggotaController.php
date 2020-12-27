<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:anggota');
    }

    public function dashboard(){
        return view('backend/anggota.dashboard');
    }
}
