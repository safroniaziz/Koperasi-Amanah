<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function bukuKas(){
        $bulans = [
            ['bulan_transaksi'  =>  'Januari'],
            ['bulan_transaksi'  =>  'Februari'],
            ['bulan_transaksi'  =>  'Maret'],
            ['bulan_transaksi'  =>  'April'],
            ['bulan_transaksi'  =>  'Mei'],
            ['bulan_transaksi'  =>  'Juni'],
            ['bulan_transaksi'  =>  'Juli'],
            ['bulan_transaksi'  =>  'Agustus'],
            ['bulan_transaksi'  =>  'September'],
            ['bulan_transaksi'  =>  'Oktober'],
            ['bulan_transaksi'  =>  'November'],
            ['bulan_transaksi'  =>  'Desember'],
        ];
        return view('backend/operator/laporan.buku_kas',compact('bulans'));
    }

    public function cariBukuKas(Request $request){
        $this->validate($request,[
            'bulan' =>  'required',
            'tahun' =>  'required',
        ]);
        if ($request->bulan == "Januari") {
            $tahun = $request->tahun-1;
            $bulan = "Desember";
        } elseif ($request->bulan == "Februari") {
            $tahun = $request->tahun;
            $bulan = "Januari";
        }elseif ($request->bulan == "Februari") {
            $tahun = $request->tahun;
            $bulan = "Januari";
        }elseif ($request->bulan == "Maret") {
            $tahun = $request->tahun;
            $bulan = "Februari";
        }elseif ($request->bulan == "April") {
            $tahun = $request->tahun;
            $bulan = "Maret";
        }elseif ($request->bulan == "Mei") {
            $tahun = $request->tahun;
            $bulan = "April";
        }elseif ($request->bulan == "Juni") {
            $tahun = $request->tahun;
            $bulan = "Mei";
        }elseif ($request->bulan == "Juli") {
            $tahun = $request->tahun;
            $bulan = "Juni";
        }elseif ($request->bulan == "Agustus") {
            $tahun = $request->tahun;
            $bulan = "Juli";
        }elseif ($request->bulan == "September") {
            $tahun = $request->tahun;
            $bulan = "Agustus";
        }elseif ($request->bulan == "Oktober") {
            $tahun = $request->tahun;
            $bulan = "September";
        }elseif ($request->bulan == "November") {
            $tahun = $request->tahun;
            $bulan = "Oktober";
        }elseif ($request->bulan == "Desember") {
            $tahun = $request->tahun;
            $bulan = "November";
        }
        $data1 = Transaksi::where('tahun_transaksi',$tahun)
                            ->select(DB::raw('SUM(jumlah_transaksi) as jumlah_transaksi'))
                            ->where('bulan_transaksi',$bulan)
                            ->where('jenis_transaksi','masuk')
                            ->first();
        $data2 = Transaksi::where('tahun_transaksi',$tahun)
                            ->select(DB::raw('SUM(jumlah_transaksi) as jumlah_transaksi'))
                            ->where('bulan_transaksi',$bulan)
                            ->where('jenis_transaksi','keluar')
                            ->first();
        $modal_awal = $data1->jumlah_transaksi - $data2->jumlah_transaksi;
        $laporans = Transaksi::join('jenis_transaksis','jenis_transaksis.id','transaksis.jenis_transaksi_id')
                                ->join('anggotas','anggotas.id','transaksis.anggota_id')
                                ->where('tahun_transaksi',$request->tahun)->where('bulan_transaksi',$request->bulan)->get();
        $bulans = [
            ['bulan_transaksi'  =>  'Januari'],
            ['bulan_transaksi'  =>  'Februari'],
            ['bulan_transaksi'  =>  'Maret'],
            ['bulan_transaksi'  =>  'April'],
            ['bulan_transaksi'  =>  'Mei'],
            ['bulan_transaksi'  =>  'Juni'],
            ['bulan_transaksi'  =>  'Juli'],
            ['bulan_transaksi'  =>  'Agustus'],
            ['bulan_transaksi'  =>  'September'],
            ['bulan_transaksi'  =>  'Oktober'],
            ['bulan_transaksi'  =>  'November'],
            ['bulan_transaksi'  =>  'Desember'],
        ];
        $bulan1 = $request->bulan;
        $tahun1 = $request->tahun;
        return view('backend/operator/laporan.buku_kas',compact('bulans','modal_awal','laporans','bulan1','tahun1'));
    }

    public function tabelaris(){
        $bulans = [
            ['bulan_transaksi'  =>  'Januari'],
            ['bulan_transaksi'  =>  'Februari'],
            ['bulan_transaksi'  =>  'Maret'],
            ['bulan_transaksi'  =>  'April'],
            ['bulan_transaksi'  =>  'Mei'],
            ['bulan_transaksi'  =>  'Juni'],
            ['bulan_transaksi'  =>  'Juli'],
            ['bulan_transaksi'  =>  'Agustus'],
            ['bulan_transaksi'  =>  'September'],
            ['bulan_transaksi'  =>  'Oktober'],
            ['bulan_transaksi'  =>  'November'],
            ['bulan_transaksi'  =>  'Desember'],
        ];
        return view('backend/operator/laporan.tabelaris',compact('bulans'));
    }

    public function cariTabelaris(Request $request){
        $this->validate($request,[
            'bulan' =>  'required',
            'tahun' =>  'required',
        ]);
        if ($request->bulan == "Januari") {
            $tahun = $request->tahun-1;
            $bulan = "Desember";
        } elseif ($request->bulan == "Februari") {
            $tahun = $request->tahun;
            $bulan = "Januari";
        }elseif ($request->bulan == "Februari") {
            $tahun = $request->tahun;
            $bulan = "Januari";
        }elseif ($request->bulan == "Maret") {
            $tahun = $request->tahun;
            $bulan = "Februari";
        }elseif ($request->bulan == "April") {
            $tahun = $request->tahun;
            $bulan = "Maret";
        }elseif ($request->bulan == "Mei") {
            $tahun = $request->tahun;
            $bulan = "April";
        }elseif ($request->bulan == "Juni") {
            $tahun = $request->tahun;
            $bulan = "Mei";
        }elseif ($request->bulan == "Juli") {
            $tahun = $request->tahun;
            $bulan = "Juni";
        }elseif ($request->bulan == "Agustus") {
            $tahun = $request->tahun;
            $bulan = "Juli";
        }elseif ($request->bulan == "September") {
            $tahun = $request->tahun;
            $bulan = "Agustus";
        }elseif ($request->bulan == "Oktober") {
            $tahun = $request->tahun;
            $bulan = "September";
        }elseif ($request->bulan == "November") {
            $tahun = $request->tahun;
            $bulan = "Oktober";
        }elseif ($request->bulan == "Desember") {
            $tahun = $request->tahun;
            $bulan = "November";
        }
        $data1 = Transaksi::where('tahun_transaksi',$tahun)
                            ->select(DB::raw('SUM(jumlah_transaksi) as jumlah_transaksi'))
                            ->where('bulan_transaksi',$bulan)
                            ->where('jenis_transaksi','masuk')
                            ->first();
        $data2 = Transaksi::where('tahun_transaksi',$tahun)
                            ->select(DB::raw('SUM(jumlah_transaksi) as jumlah_transaksi'))
                            ->where('bulan_transaksi',$bulan)
                            ->where('jenis_transaksi','keluar')
                            ->first();
        $modal_awal = $data1->jumlah_transaksi - $data2->jumlah_transaksi;
        $laporans = Transaksi::join('jenis_transaksis','jenis_transaksis.id','transaksis.jenis_transaksi_id')
                                ->join('anggotas','anggotas.id','transaksis.anggota_id')
                                ->where('tahun_transaksi',$request->tahun)->where('bulan_transaksi',$request->bulan)->get();
        $bulans = [
            ['bulan_transaksi'  =>  'Januari'],
            ['bulan_transaksi'  =>  'Februari'],
            ['bulan_transaksi'  =>  'Maret'],
            ['bulan_transaksi'  =>  'April'],
            ['bulan_transaksi'  =>  'Mei'],
            ['bulan_transaksi'  =>  'Juni'],
            ['bulan_transaksi'  =>  'Juli'],
            ['bulan_transaksi'  =>  'Agustus'],
            ['bulan_transaksi'  =>  'September'],
            ['bulan_transaksi'  =>  'Oktober'],
            ['bulan_transaksi'  =>  'November'],
            ['bulan_transaksi'  =>  'Desember'],
        ];
        $bulan1 = $request->bulan;
        $tahun1 = $request->tahun;
        return view('backend/operator/laporan.tabelaris',compact('bulans','modal_awal','laporans','bulan1','tahun1'));
    }

    public function catSimpWajib(){
        $laporans = Transaksi::where('jenis_transaksi_id',1)
                    ->join('anggotas','anggotas.id','transaksis.anggota_id')
                    ->select(DB::raw('COUNT(bulan_transaksi) as jumlah_bulan'),DB::raw('SUM(jumlah_transaksi) as jumlah_transaksi'),'nm_anggota')
                    ->groupBy('anggota_id')
                    ->get();
        return view('backend/operator/laporan.cat_simp_wajib',compact('laporans'));
    }
}
