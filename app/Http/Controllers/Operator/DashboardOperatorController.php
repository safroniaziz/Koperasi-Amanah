<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardOperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function dashboard(){
        return view('backend/operator.dashboard');
    }
}
