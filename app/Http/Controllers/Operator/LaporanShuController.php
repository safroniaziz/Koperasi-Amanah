<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanShuController extends Controller
{
    public function simpJasa(){
        return view('backend/operator.shu.simp_jasa');
    }
}
