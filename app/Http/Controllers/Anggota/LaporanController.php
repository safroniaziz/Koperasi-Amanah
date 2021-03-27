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
        $modal_awal = $data1->jumlah_transaksi - $data2->jumlah_transaksi;
        $laporans = Transaksi::join('jenis_transaksis','jenis_transaksis.id','transaksis.jenis_transaksi_id')
                                ->join('anggotas','anggotas.id','transaksis.anggota_id')
                                ->where('anggota_id',Auth::guard('anggota')->user()->id)
                                ->where('tahun_transaksi',$request->tahun)->where('bulan_transaksi',$request->bulan)->get();
        $bulan1 = $request->bulan;
        $tahun1 = $request->tahun;
        $pdf = PDF::loadView('backend/anggota/laporan.print_tabelaris',compact('modal_awal','laporans','bulan1','tahun1'))->setPaper('A4','landscape');
        return$pdf->stream();
    }

    public function catSimpWajib(){
        $laporans = Transaksi::where('jenis_transaksi_id',1)
                    ->join('anggotas','anggotas.id','transaksis.anggota_id')
                    ->select(DB::raw('COUNT(bulan_transaksi) as jumlah_bulan'),DB::raw('SUM(jumlah_transaksi) as jumlah_transaksi'),'nm_anggota')
                    ->where('anggota_id',Auth::guard('anggota')->user()->id)
                    ->groupBy('anggota_id')
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
        $saldo = Pinjaman::where('anggota_id',$request->anggota)->select('jumlah_pinjaman','jumlah_angsuran_pokok','jumlah_bulan','jumlah_angsuran_bunga','status_pinjaman')->first();
        $angsuran = Transaksi::where('anggota_id',$request->anggota)->where('jenis_transaksi_id',4)->get();
        if (!empty($saldo)) {
            $pdf = PDF::loadView('backend/anggota/laporan.print_kartu_pinjaman',compact('saldo','angsuran','anggota'))->setPaper('A4','landscape');
            return$pdf->stream();
        }
        else{
            return redirect()->back()->with(['error'    =>  'Anggota Tidak Memiliki Hutang']);
        }
        // return view('backend/anggota/laporan.print_kartu_pinjaman.blade.php',compact('saldo','angsuran','anggotas'));
    }

    public function shu(){
        $tahun = PembagianShu::select('tahun')->get();
        return view('backend/anggota.shu.shu_anggota',compact('tahun'));
    }

    public function lihatShu(){
        if (isset($_GET['tahun'])) {
            $keseluruhan = JumlahKeseluruhan::first();
            $pembagian_shu = PembagianShu::where('tahun',$_GET['tahun'])->first();
            $tahun = PembagianShu::select('tahun')->get();
            $shus = Anggota::join('simpanan_anggotas','simpanan_anggotas.anggota_id','anggotas.id')
                            ->join('simpanan_jasas','simpanan_jasas.anggota_id','anggotas.id')
                            ->join('jabatans','jabatans.id','anggotas.jabatan_id')
                            ->select('nm_anggota','nm_jabatan',DB::raw('(simpanan_anggotas.jumlah / "'.$keseluruhan->jumlah_simpanan_seluruh.'")* ("'.$pembagian_shu->shu_simpanan.'") as shu_simpanan'),
                                    DB::raw('(simpanan_jasas.jumlah / "'.$keseluruhan->jumlah_jasa_seluruh.'") * ("'.$pembagian_shu->shu_jasa_pinjaman.'") as shu_jasa'))
                            ->where('anggotas.id',Auth::guard('anggota')->user()->id)
                            ->get();
            return view('backend/anggota.shu.shu_anggota',compact('tahun','shus'));
        }
    }
}