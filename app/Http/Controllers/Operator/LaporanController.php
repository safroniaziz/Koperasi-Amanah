<?php

namespace App\Http\Controllers\Operator;

use App\Anggota;
use App\CatatanBulan;
use App\Http\Controllers\Controller;
use App\Jabatan;
use App\Pinjaman;
use App\Transaksi;
use Barryvdh\DomPDF\Facade as PDF;
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
            $bulan = 'Desember';
            $angka_sebelumnya = '12';
            $angka_sekarang = '01';
            $sebelumnya = '11';
        } elseif ($request->bulan == "Februari") {
            $tahun = $request->tahun;
            $bulan = 'Januari';
            $angka_sebelumnya = '01';
            $angka_sekarang = '02';
            $sebelumnya = '12';
        }elseif ($request->bulan == "Maret") {
            $tahun = $request->tahun;
            $bulan = 'Februari';
            $angka_sebelumnya = '02';
            $angka_sekarang = '03';
            $sebelumnya = '01';
        }elseif ($request->bulan == "April") {
            $tahun = $request->tahun;
            $bulan = 'Maret';
            $angka_sebelumnya = '03';
            $angka_sekarang = '04';
            $sebelumnya = '02';
        }elseif ($request->bulan == "Mei") {
            $tahun = $request->tahun;
            $bulan = 'April';
            $angka_sebelumnya = '04';
            $angka_sekarang = '05';
            $sebelumnya = '03';
        }elseif ($request->bulan == "Juni") {
            $tahun = $request->tahun;
            $bulan = 'Mei';
            $angka_sebelumnya = '05';
            $angka_sekarang = '06';
            $sebelumnya = '04';
        }elseif ($request->bulan == "Juli") {
            $tahun = $request->tahun;
            $bulan = 'Juni';
            $angka_sebelumnya = '06';
            $angka_sekarang = '07';
            $sebelumnya = '05';
        }elseif ($request->bulan == "Agustus") {
            $tahun = $request->tahun;
            $bulan = 'Juli';
            $angka_sebelumnya = '07';
            $angka_sekarang = '08';
            $sebelumnya = '06';
        }elseif ($request->bulan == "September") {
            $tahun = $request->tahun;
            $bulan = 'Agustus';
            $angka_sebelumnya = '08';
            $angka_sekarang = '09';
            $sebelumnya = '07';
        }elseif ($request->bulan == "Oktober") {
            $tahun = $request->tahun;
            $bulan = 'September';
            $angka_sebelumnya = '09';
            $angka_sekarang = '10';
            $sebelumnya = '08';
        }elseif ($request->bulan == "November") {
            $tahun = $request->tahun;
            $bulan = 'Oktober';
            $angka_sebelumnya = '10';
            $angka_sekarang = '11';
            $sebelumnya = '09';
        }elseif ($request->bulan == "Desember") {
            $tahun = $request->tahun;
            $bulan = 'November';
            $angka_sebelumnya = '11';
            $angka_sekarang = '12';
            $sebelumnya = '10';
        }
        $data1 = Transaksi::select(DB::raw('sum(jumlah_transaksi) as jumlah_transaksi'))
                            ->whereYear('tanggal_transaksi',$request->tahun)
                            ->whereMonth('tanggal_transaksi',$angka_sebelumnya)
                            ->where('jenis_transaksi','masuk')
                            ->first();
                            // return $data1;
        $data2 = Transaksi::where('tahun_transaksi',$request->tahun)
                            ->select(DB::raw('SUM(jumlah_transaksi) as jumlah_transaksi'))
                            ->whereMonth('tanggal_transaksi',$angka_sebelumnya)
                            ->where('jenis_transaksi','keluar')
                            ->first();
        // $selang1 = Transaksi::select(DB::raw('sum(jumlah_transaksi) as jumlah_transaksi'))
        //                     ->whereYear('tanggal_transaksi',$request->tahun)
        //                     ->whereMonth('tanggal_transaksi',$sebelumnya)
        //                     ->where('jenis_transaksi','masuk')
        //                     ->first();
        //                     // return $selang1;
        // $selang2 = Transaksi::where('tahun_transaksi',$request->tahun)
        //                     ->select(DB::raw('SUM(jumlah_transaksi) as jumlah_transaksi'))
        //                     ->whereMonth('tanggal_transaksi',$sebelumnya)
        //                     ->where('jenis_transaksi','keluar')
        //                     ->first();
                            // return $selang2;
        if ($request->bulan == "Januari" && $request->tahun == "2021") {
            $awal = 6061417;
            // $modal_sebelumnya = 0;
            // $awal = $data1->jumlah_transaksi - $data2->jumlah_transaksi;
        } else if($request->bulan == "Februari" && $request->tahun == "2021"){
            // $modal_sebelumnya = 6061417;
            $awal = ($data1->jumlah_transaksi - $data2->jumlah_transaksi);
        }
        else{
            // $modal_sebelumnya = $selang1->jumlah_transaksi-$selang2->jumlah_transaksi;
            $awal = ($data1->jumlah_transaksi - $data2->jumlah_transaksi);
        }
        $input = CatatanBulan::where('tahun',$request->tahun)->where('bulan',$angka_sekarang)->first();
        if (empty($input)) {
            
            $modal_sebelumnya = CatatanBulan::where('tahun',$request->tahun)->where('bulan',$angka_sekarang -1)->first();
            $modal_sekarang = CatatanBulan::where('tahun',$request->tahun)->where('bulan',$angka_sekarang -1)->first();
            $modal_awal = $modal_sekarang->modal_awal;
            CatatanBulan::create([
                'tahun' =>  $request->tahun,
                'bulan' =>  $angka_sekarang,
                'modal_awal'    =>  $modal_awal,
            ]);
            $data = array([
                'data1' =>  $data1,
                'data2' =>  $data2,
                'modal_awal' =>  $modal_awal,
                'modal_sebelumnya'  =>  $modal_sebelumnya,
                'jumlah'    =>  $data1->jumlah_transaksi - $data2->jumlah_transaksi,
            ]);
            // return $data;

            $laporans = Transaksi::join('jenis_transaksis','jenis_transaksis.id','transaksis.jenis_transaksi_id')
                                ->join('anggotas','anggotas.id','transaksis.anggota_id')
                                // ->select('transaksis.id','jumlah_transaksi')
                                ->whereYear('tanggal_transaksi',$request->tahun)->whereMonth('tanggal_transaksi',$angka_sekarang)
                                ->orderBy('transaksis.created_at','asc')
                                ->get();
                                return $laporans;
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
            
        } else{
            if ($request->bulan == "Januari" && $request->tahun == "2021"){
                $modal_sebelumnya = 0;
                $modal_awal = $awal;
            } else if($request->bulan == "Februari" && $request->tahun == "2021"){
                $modal_sekarang = CatatanBulan::where('tahun',$request->tahun)->where('bulan',$angka_sekarang)->first();
                $modal_awal = $modal_sekarang->modal_awal;

            } else{
                $modal_sebelumnya = CatatanBulan::where('tahun',$request->tahun)->where('bulan',$angka_sekarang -1)->first();
                $modal_sekarang = CatatanBulan::where('tahun',$request->tahun)->where('bulan',$angka_sekarang)->first();
                $modal_awal = $modal_sekarang->modal_awal;
            }
            // $data = array([
            //     'data1' =>  $data1,
            //     'data2' =>  $data2,
            //     'modal_awal' =>  $modal_awal,
            //     'modal_sebelumnya'  =>  $modal_sebelumnya,
            //     'jumlah'    =>  $data1->jumlah_transaksi - $data2->jumlah_transaksi,
            // ]);

            $laporans = Transaksi::join('jenis_transaksis','jenis_transaksis.id','transaksis.jenis_transaksi_id')
                                ->join('anggotas','anggotas.id','transaksis.anggota_id')
                                // ->select('transaksis.id','jumlah_transaksi')
                                ->whereYear('tanggal_transaksi',$request->tahun)->whereMonth('tanggal_transaksi',$angka_sekarang)
                                ->orderBy('transaksis.created_at','asc')
                                ->get();
                                // return $laporans;
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
        // $modal_awal = $data1->jumlah_transaksi - $data2->jumlah_transaksi +6061417;

        // $modal_awal = 0;
       
        
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
            $bulan = 'Desember';
        } elseif ($request->bulan == "Februari") {
            $tahun = $request->tahun;
            $bulan = 'Januari';
        }elseif ($request->bulan == "Februari") {
            $tahun = $request->tahun;
            $bulan = 'Januari';
        }elseif ($request->bulan == "Maret") {
            $tahun = $request->tahun;
            $bulan = 'Februari';
        }elseif ($request->bulan == "April") {
            $tahun = $request->tahun;
            $bulan = 'Maret';
        }elseif ($request->bulan == "Mei") {
            $tahun = $request->tahun;
            $bulan = 'April';
        }elseif ($request->bulan == "Juni") {
            $tahun = $request->tahun;
            $bulan = 'Mei';
        }elseif ($request->bulan == "Juli") {
            $tahun = $request->tahun;
            $bulan = 'Juni';
        }elseif ($request->bulan == "Agustus") {
            $tahun = $request->tahun;
            $bulan = 'Juli';
        }elseif ($request->bulan == "September") {
            $tahun = $request->tahun;
            $bulan = 'Agustus';
        }elseif ($request->bulan == "Oktober") {
            $tahun = $request->tahun;
            $bulan = 'September';
        }elseif ($request->bulan == "November") {
            $tahun = $request->tahun;
            $bulan = 'Oktober';
        }elseif ($request->bulan == "Desember") {
            $tahun = $request->tahun;
            $bulan = 'November';
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
                                ->where('tahun_transaksi',$request->tahun)->where('bulan_transaksi',$request->bulan)
                                ->orderBy('transaksis.created_at','asc')
                                ->get();
        $bulan1 = $request->bulan;
        $tahun1 = $request->tahun;
        $ketua = Jabatan::where('nm_jabatan','like','%ketua%')->first();
        $sekretaris = Jabatan::where('nm_jabatan','like','%sekretaris%')->first();
        $mytime = \Carbon\Carbon::now();
        $time = $mytime->toDateString();
        $pdf = PDF::loadView('backend/operator/laporan.print_tabelaris',compact('modal_awal','laporans','bulan1','tahun1','ketua','sekretaris','time'))->setPaper('A4','portrait');
        return$pdf->stream();
    }

    public function catSimpWajib(){
        $laporans = Transaksi::where('jenis_transaksi_id',1)
                    ->join('anggotas','anggotas.id','transaksis.anggota_id')
                    ->select('anggotas.id as anggota_id',DB::raw('COUNT(bulan_transaksi) as jumlah_bulan'),DB::raw('SUM(jumlah_transaksi) as jumlah_transaksi'),'nm_anggota')
                    ->groupBy('anggota_id')
                    ->get();
        return view('backend/operator/laporan.cat_simp_wajib',compact('laporans'));
    }

    public function detailSimpWajib($anggota_id){
        $data = Transaksi::join('anggotas','anggotas.id','transaksis.anggota_id')
                        ->select('bulan_transaksi','tahun_transaksi','jumlah_transaksi','jenis_transaksi')
                        ->where('jenis_transaksi_id',1)
                        ->where('anggotas.id',$anggota_id)
                        ->get();
        return $data;
    }

    public function pinjaman(){
        $anggotas = Anggota::all();
        return view('backend/operator/laporan.kartu_pinjaman',compact('anggotas'));
    }

    public function cariKartu(Request $request){
        $this->validate($request,[
            'anggota'   =>  'required',
        ]);
        $anggota = Anggota::where('id',$request->anggota)->first();
        $saldo = Pinjaman::where('anggota_id',$request->anggota)->select('jumlah_pinjaman','jumlah_angsuran_pokok','jumlah_bulan','jumlah_angsuran_bunga','status_pinjaman')->first();
        $angsuran = Transaksi::where('anggota_id',$request->anggota)->where('jenis_transaksi_id',4)->get();
        if (!empty($saldo)) {
            $pdf = PDF::loadView('backend/operator/laporan.print_kartu_pinjaman',compact('saldo','angsuran','anggota'))->setPaper('A4','landscape');
            return$pdf->stream();
        }
        else{
            return redirect()->back()->with(['error'    =>  'Anggota Tidak Memiliki Hutang']);
        }
        // return view('backend/operator/laporan.print_kartu_pinjaman.blade.php',compact('saldo','angsuran','anggotas'));
    }
}
