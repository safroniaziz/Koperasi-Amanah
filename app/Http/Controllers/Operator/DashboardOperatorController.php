<?php

namespace App\Http\Controllers\Operator;

use App\Anggota;
use App\Berita;
use App\Http\Controllers\Controller;
use App\JenisTransaksi;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardOperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function dashboard(){
        $anggota = Count(Anggota::where('nm_anggota','!=','Koperasi')->get());
        $berita = Count(Berita::all());
        $jenis = Count(JenisTransaksi::where('status_jenis_transaksi','1')->get());
        $simpanan = Transaksi::where('jenis_transaksi_id','1')->select(DB::raw('sum(jumlah_transaksi) as jumlah'))->first();
        $datas = Anggota::rightJoin('transaksis','transaksis.anggota_id','anggotas.id')->where('jenis_transaksi_id','1')
                            ->select('nm_anggota',DB::raw('sum(jumlah_transaksi) as jumlah'))
                            ->groupBy('anggotas.id')->get();
        return view('backend/operator.dashboard',compact('anggota','berita','jenis','simpanan','datas'));
    }
}
