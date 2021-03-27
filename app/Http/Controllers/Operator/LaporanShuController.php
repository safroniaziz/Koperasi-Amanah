<?php

namespace App\Http\Controllers\Operator;

use App\Anggota;
use App\Http\Controllers\Controller;
use App\JumlahKeseluruhan;
use App\PembagianShu;
use App\Pinjaman;
use App\ShuTahunBerjalan;
use App\SimpananAnggota;
use App\SimpananJasa;
use App\Transaksi;
use CreatePinjamenTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanShuController extends Controller
{
    public function simpJasa(){
        $simpanans = Anggota::join('simpanan_anggotas','simpanan_anggotas.anggota_id','anggotas.id')
                                ->join('simpanan_jasas','simpanan_jasas.anggota_id','anggotas.id')
                                ->select('nm_anggota','simpanan_anggotas.jumlah as jumlah_simpanan','simpanan_jasas.jumlah as jumlah_jasa')
                                ->groupBy('anggotas.id')
                                ->get();
        return view('backend/operator.shu.simp_jasa',compact('simpanans'));
    }

    public function generateSimpJasa(){
        $simp = Transaksi::join('jenis_transaksis','jenis_transaksis.id','transaksis.jenis_transaksi_id')
                            ->where('jenis_transaksis.id',1)
                            ->select('anggota_id',DB::raw('sum(jumlah_transaksi) as jumlah'))
                            ->groupBy('anggota_id')
                            ->get();
        
        for ($i=0; $i < count($simp) ; $i++) { 
            $jasa = Pinjaman::join('anggotas','anggotas.id','pinjamen.anggota_id')
                        ->where('anggotas.id',$simp[$i]['anggota_id'])
                        ->select('anggota_id',DB::raw('sum(jumlah_angsuran_bunga) as jumlah'))
                        ->first();
            SimpananAnggota::create([
                'anggota_id'    =>  $simp[$i]['anggota_id'],
                'jumlah'    =>  $simp[$i]['jumlah'],
            ]);

            if ($jasa->anggota_od != null) {
                SimpananJasa::create([
                    'anggota_id'    =>  $simp[$i]['anggota_id'],
                    'jumlah'    =>  $jasa->jumlah,
                ]);
            }
        }

        $simpanans = Anggota::join('simpanan_anggotas','simpanan_anggotas.anggota_id','anggotas.id')
                                ->join('simpanan_jasas','simpanan_jasas.anggota_id','anggotas.id')
                                ->select('nm_anggota','simpanan_anggotas.jumlah as jumlah_simpanan','simpanan_jasas.jumlah as jumlah_jasa')
                                ->groupBy('anggotas.id')
                                ->get();
        return view('backend/operator.shu.simp_jasa',compact('simpanans'));
    }

    public function shuTahunBerjalan(){
        $shus = ShuTahunBerjalan::all();
        return view('backend/operator.shu.shu_tahun_berjalan',compact('shus'));
    }

    public function generateTahunBerjalan(){
        $year = date('Y');
        $jasa = SimpananJasa::select(DB::raw('sum(jumlah) as jumlah'))->first();
        $keluar = Transaksi::join('jenis_transaksis','jenis_transaksis.id','transaksis.jenis_transaksi_id')
                            ->where('jenis_transaksis.id',5)
                            ->select(DB::raw('sum(jumlah_transaksi) as jumlah'))
                            ->first();
        ShuTahunBerjalan::create([
            'tahun' =>  $year,
            'jumlah'    =>  $jasa->jumlah - $keluar->jumlah,
        ]);

        $shus = ShuTahunBerjalan::all();
        return view('backend/operator.shu.shu_tahun_berjalan',compact('shus'));
    }

    public function persentaseShu(){
        $persentases = PembagianShu::all();
        return view('backend/operator.shu.persentase_shu',compact('persentases'));
    }

    public function generatePersentase(){
        $year = date('Y');
        $shu = ShuTahunBerjalan::where('tahun',$year)->select('jumlah')->first();
        PembagianShu::create([
            'tahun' =>  $year,
            'persentase_simpanan'   =>  '20%',
            'persentase_jasa'   =>  '30%',
            'shu_tahun_berjalan'   =>  $shu->jumlah,
            'shu_simpanan'   =>  $shu->jumlah * 20/100,
            'shu_jasa_pinjaman'   =>  $shu->jumlah * 30/100,
        ]);

        $persentases = PembagianShu::all();
        return view('backend/operator.shu.persentase_shu',compact('persentases'));
    }
    
    public function shuAnggota(){
        // $keseluruhan = JumlahKeseluruhan::first();
        $tahun = PembagianShu::select('tahun')->get();
        // if (empty($pembagian_shu)) {
        //     return redirect()->back()->with(['error'    =>  'Tidak Bisa Melihat SHU Anggota, Karena Persentase Pembagian SHU Belum Tersedia']);
        // }
        // $shus = Anggota::join('simpanan_anggotas','simpanan_anggotas.anggota_id','anggotas.id')
        //                 ->join('simpanan_jasas','simpanan_jasas.anggota_id','anggotas.id')
        //                 ->join('jabatans','jabatans.id','anggotas.jabatan_id')
        //                 ->select('nm_anggota','nm_jabatan',DB::raw('(simpanan_anggotas.jumlah / "'.$keseluruhan->jumlah_simpanan_seluruh.'")* ("'.$pembagian_shu->shu_simpanan.'") as shu_simpanan'),
        //                         DB::raw('(simpanan_jasas.jumlah / "'.$keseluruhan->jumlah_jasa_seluruh.'") * ("'.$pembagian_shu->shu_jasa_pinjaman.'") as shu_jasa'))
        //                 ->groupBy('anggotas.id')
        //                 ->get();
        return view('backend/operator.shu.shu_anggota',compact('tahun'));
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
                            ->groupBy('anggotas.id')
                            ->get();
            return view('backend/operator.shu.shu_anggota',compact('tahun','shus'));
        }
    }
}
