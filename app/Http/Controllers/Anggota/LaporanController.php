<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pinjaman;
use App\Transaksi;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Anggota;
use App\JumlahKeseluruhan;
use App\PembagianShu;
use App\ShuAnggota;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:anggota');
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
        return view('backend/anggota/laporan.buku_kas',compact('bulans'));
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
                            ->where('anggota_id',Auth::guard('anggota')->user()->id)
                            ->first();
        $data2 = Transaksi::where('tahun_transaksi',$tahun)
                            ->select(DB::raw('SUM(jumlah_transaksi) as jumlah_transaksi'))
                            ->where('bulan_transaksi',$bulan)
                            ->where('jenis_transaksi','keluar')
                            ->where('anggota_id',Auth::guard('anggota')->user()->id)
                            ->first();
        $modal_awal = $data1->jumlah_transaksi - $data2->jumlah_transaksi;
        $laporans = Transaksi::join('jenis_transaksis','jenis_transaksis.id','transaksis.jenis_transaksi_id')
                                ->join('anggotas','anggotas.id','transaksis.anggota_id')
                                ->where('anggota_id',Auth::guard('anggota')->user()->id)
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
        return view('backend/anggota/laporan.buku_kas',compact('bulans','modal_awal','laporans','bulan1','tahun1'));
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
        return view('backend/anggota/laporan.tabelaris',compact('bulans'));
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
                            ->where('anggota_id',Auth::guard('anggota')->user()->id)
                            ->first();
        $data2 = Transaksi::where('tahun_transaksi',$tahun)
                            ->select(DB::raw('SUM(jumlah_transaksi) as jumlah_transaksi'))
                            ->where('bulan_transaksi',$bulan)
                            ->where('jenis_transaksi','keluar')
                            ->where('anggota_id',Auth::guard('anggota')->user()->id)
                            ->first();
        $mytime = \Carbon\Carbon::now();
        $time = $mytime->toDateString();
        $modal_awal = $data1->jumlah_transaksi - $data2->jumlah_transaksi;
        $laporans = Transaksi::join('jenis_transaksis','jenis_transaksis.id','transaksis.jenis_transaksi_id')
                                ->join('anggotas','anggotas.id','transaksis.anggota_id')
                                ->where('anggota_id',Auth::guard('anggota')->user()->id)
                                ->where('tahun_transaksi',$request->tahun)->where('bulan_transaksi',$request->bulan)->get();
        $bulan1 = $request->bulan;
        $tahun1 = $request->tahun;
        $pdf = PDF::loadView('backend/anggota/laporan.print_tabelaris',compact('modal_awal','laporans','bulan1','tahun1','time'))->setPaper('A4','landscape');
        return$pdf->stream();
    }

    public function catSimpWajib(){
        $laporans = Transaksi::where('jenis_transaksi_id',1)
                    ->join('anggotas','anggotas.id','transaksis.anggota_id')
                    ->select('jumlah_transaksi','nm_anggota','bulan_transaksi','tahun_transaksi')
                    ->where('anggota_id',Auth::guard('anggota')->user()->id)
                    ->get();
        return view('backend/anggota/laporan.cat_simp_wajib',compact('laporans'));
    }

    public function pinjaman(){
        $anggotas = Anggota::where('id',Auth::guard('anggota')->user()->id)->get();
        return view('backend/anggota/laporan.kartu_pinjaman',compact('anggotas'));
    }

    public function cariKartu(Request $request){
        $this->validate($request,[
            'anggota'   =>  'required',
        ]);
        $anggota = Anggota::where('id',$request->anggota)->first();
        $saldo = Pinjaman::where('id',$request->pinjaman)->select('jumlah_pinjaman','jumlah_angsuran_pokok','jumlah_bulan','jumlah_angsuran_bunga','status_pinjaman')->first();
        // $angsuran = Transaksi::leftJoin('transaksi_pinjamen','transaksi_pinjamen.transaksi_id','transaksis.id')
        //                         ->where('anggota_id',$request->anggota)
        //                         ->where('jenis_transaksi_id',4)
        //                         ->where('transaksi_pinjamen.pinjaman_id',20)
        //                         ->orderBy('tanggal_transaksi')
        //                         ->get();
        // return $request->all();
        $angsuran = DB::table('transaksi_pinjamen')
                        ->rightJoin('pinjamen','pinjamen.id','transaksi_pinjamen.pinjaman_id')
                        ->rightJoin('transaksis','transaksis.id','transaksi_pinjamen.transaksi_id')
                        ->where('pinjaman_id',$request->pinjaman)
                        ->where('transaksis.anggota_id',$request->anggota)
                        ->where('jenis_transaksi_id',3)
                        ->orderBy('tanggal_transaksi')
                        ->get();
        // return $angsuran;
        if (!empty($saldo)) {
            // return $saldo;
            $pdf = PDF::loadView('backend/operator/laporan.print_kartu_pinjaman',compact('saldo','angsuran','anggota'))->setPaper('A4','landscape');
            return$pdf->stream();
        }
        else{
            return redirect()->back()->with(['error'    =>  'Anggota Tidak Memiliki Hutang']);
        }
        // return view('backend/operator/laporan.print_kartu_pinjaman.blade.php',compact('saldo','angsuran','anggotas'));
    }

    public function shu(){
        $tahun = PembagianShu::select('tahun')->get();
        return view('backend/anggota.shu.shu_anggota',compact('tahun'));
    }

    public function lihatShu(){
        if (isset($_GET['tahun'])) {
            $shus = ShuAnggota::where('tahun',$_GET['tahun'])->where('anggota_id',Auth::guard('anggota')->user()->id)->get();
            return view('backend/anggota.shu.shu_anggota',compact('shus'));
        }
    }

    public function cariPinjaman(Request $request){
        $pinjaman =Pinjaman::where('anggota_id',$request->anggota)->select('id','jumlah_pinjaman')->get();
        return $pinjaman;
    }
}
