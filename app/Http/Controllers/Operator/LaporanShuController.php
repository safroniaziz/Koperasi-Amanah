<?php

namespace App\Http\Controllers\Operator;

use App\Anggota;
use App\Http\Controllers\Controller;
use App\JumlahKeseluruhan;
use App\PembagianShu;
use App\Pinjaman;
use App\ShuAnggota;
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
        $year = date('Y');
        $simpanans = Anggota::leftJoin('simpanan_anggotas','simpanan_anggotas.anggota_id','anggotas.id')
                                ->leftJoin('simpanan_jasas','simpanan_jasas.anggota_id','anggotas.id')
                                ->select('nm_anggota','simpanan_anggotas.jumlah as jumlah_simpanan','simpanan_jasas.jumlah as jumlah_jasa')
                                ->groupBy('anggotas.id')
                                ->get();
        return view('backend/operator.shu.simp_jasa',compact('simpanans','year'));
    }

    public function generateSimpJasa(){
        $year = date('Y');
        $hapus_simpanan = SimpananAnggota::where('tahun',$year)->get();
        $hapus_jasa = SimpananJasa::where('tahun',$year)->get();
        if (!empty($hapus_simpanan)) {
            SimpananAnggota::where('tahun',$year)->delete();
        }
        if (!empty($hapus_jasa)) {
            SimpananJasa::where('tahun',$year)->delete();
        }
        $data_simpanan = Transaksi::rightJoin('anggotas','anggotas.id','transaksis.anggota_id')->where('tahun_transaksi',$year)->where('jenis_transaksi_id','1')->select('anggotas.id as anggota_id',DB::raw('sum(jumlah_transaksi) as jumlah'))->groupBy('anggotas.id')->get();
        $data_jasa = Transaksi::rightJoin('anggotas','anggotas.id','transaksis.anggota_id')->where('tahun_transaksi',$year)->where('jenis_transaksi_id','4')->select('anggotas.id as anggota_id',DB::raw('sum(jumlah_transaksi) as jumlah'))->groupBy('anggotas.id')->get();
        foreach ($data_simpanan as $data_simpanan) {
            SimpananAnggota::create([
                'anggota_id'    =>  $data_simpanan->anggota_id,
                'tahun' =>  $year,
                'jumlah'    =>  $data_simpanan->jumlah,
            ]);
        }

        foreach ($data_jasa as $data_jasa) {
            SimpananJasa::create([
                'anggota_id'    =>  $data_jasa->anggota_id,
                'tahun' =>  $year,
                'jumlah'    =>  $data_jasa->jumlah,
            ]);
        }
        $simpanan = SimpananAnggota::select(DB::raw('sum(jumlah) as jumlah'))->first();
        $jasa = SimpananJasa::select(DB::raw('sum(jumlah) as jumlah'))->first();
        $transaksi = Transaksi::where('jenis_transaksi_id','>','5')->where('jenis_transaksi','keluar')->select(DB::raw('sum(jumlah_transaksi) as jumlah'))->first();
        $keseluruhan = JumlahKeseluruhan::where('tahun',$year)->get();
        if (count($keseluruhan)>0) {
            JumlahKeseluruhan::where('tahun',$year)->delete();
            JumlahKeseluruhan::create([
                'jumlah_simpanan_seluruh'   =>  $simpanan->jumlah,
                'jumlah_jasa_seluruh'   =>  $jasa->jumlah,
                'jumlah_transaksi_seluruh'          =>  $transaksi->jumlah,
                'tahun' =>  $year
            ]);
        }
        else{
            JumlahKeseluruhan::create([
                'jumlah_simpanan_seluruh'   =>  $simpanan->jumlah,
                'jumlah_jasa_seluruh'   =>  $jasa->jumlah,
                'jumlah_transaksi_seluruh'          =>  $transaksi->jumlah,
                'tahun' =>  $year
            ]);
        }

        $simpanans = Anggota::leftJoin('simpanan_anggotas','simpanan_anggotas.anggota_id','anggotas.id')
                                ->leftJoin('simpanan_jasas','simpanan_jasas.anggota_id','anggotas.id')
                                ->select('nm_anggota','simpanan_anggotas.jumlah as jumlah_simpanan','simpanan_jasas.jumlah as jumlah_jasa')
                                ->groupBy('anggotas.id')
                                ->get();
        return view('backend/operator.shu.simp_jasa',compact('simpanans','year'));
    }

    public function shuTahunBerjalan(){
        $year = date('Y');
        $shus = ShuTahunBerjalan::all();
        return view('backend/operator.shu.shu_tahun_berjalan',compact('shus','year'));
    }

    public function generateTahunBerjalan(){
        $year = date('Y');
        $jasa = SimpananJasa::select(DB::raw('sum(jumlah) as jumlah'))->first();
        $keluar = JumlahKeseluruhan::select('jumlah_transaksi_seluruh as jumlah')->where('tahun',$year)->first();
        $tahun_berjalan = ShuTahunBerjalan::where('tahun',$year)->get();
        if (count($tahun_berjalan)>0) {
            ShuTahunBerjalan::where('tahun',$year)->delete();
        }
        ShuTahunBerjalan::create([
            'tahun' =>  $year,
            'jumlah'    =>  $jasa->jumlah - $keluar->jumlah,
        ]);

        $shus = ShuTahunBerjalan::all();
        return view('backend/operator.shu.shu_tahun_berjalan',compact('shus','year'));
    }

    public function persentaseShu(){
        $year = date('Y');
        $persentases = PembagianShu::all();
        return view('backend/operator.shu.persentase_shu',compact('persentases','year'));
    }

    public function generatePersentase(){
        $year = date('Y');
        $shu = ShuTahunBerjalan::where('tahun',$year)->select('jumlah')->first();
        $pembagian_shu = PembagianShu::where('tahun',$year)->get();
        if (count($pembagian_shu)>0) {
            PembagianShu::where('tahun',$year)->delete();
        }
        PembagianShu::create([
            'tahun' =>  $year,
            'persentase_simpanan'   =>  '20%',
            'persentase_jasa'   =>  '30%',
            'shu_tahun_berjalan'   =>  $shu->jumlah,
            'shu_simpanan'   =>  $shu->jumlah * 20/100,
            'shu_jasa_pinjaman'   =>  $shu->jumlah * 30/100,
        ]);

        $persentases = PembagianShu::all();
        return view('backend/operator.shu.persentase_shu',compact('persentases','year'));
    }

    public function shuAnggota(){
        $anggotas = Anggota::where('nm_anggota','!=','Koperasi')->get();
        $shus = ShuAnggota::select('id','shu_anggotas.nm_anggota','jabatan','shu_simpanan','shu_jasa','jumlah')
                            ->get();
        $jumlah = ShuAnggota::select('nm_anggota',DB::raw('sum(jumlah) as jumlah'))
                            ->groupBy('anggota_id')
                            ->get();
        return view('backend/operator.shu.shu_anggota',compact('shus','anggotas','jumlah'));
    }

    public function simpanShu(Request $request){
        $attributes = [
            'anggota_id'    =>  'Nama Anggota',
            'tahun'         =>  'Tahun',
            'shu_jasa'      =>  'Jumlah Shu Jasa',
            'shu_simpanan'  =>  'Jumlah Shu Simpanan',
            'jumlah'        =>  'Jumlah Shu Diterima',
        ];
        $this->validate($request, [
            'anggota_id'    =>'required',
            'tahun'         =>'required',
            'shu_jasa'      =>'required',
            'shu_simpanan'  =>'required',
            'jumlah'        =>'required',
        ],$attributes);
        DB::beginTransaction();
        try {
            $anggota = Anggota::join('jabatans','jabatans.id','anggotas.jabatan_id')
                                ->select('nm_anggota','nm_jabatan')
                                ->where('anggotas.id',$request->anggota_id)->first();
            ShuAnggota::create([
                'anggota_id'    =>  $request->anggota_id,
                'jabatan'       =>  $anggota->nm_jabatan,
                'nm_anggota'       =>  $anggota->nm_anggota,
                'tahun'         =>  $request->tahun,
                'shu_jasa'      =>  $request->shu_jasa,
                'shu_simpanan'  =>  $request->shu_simpanan,
                'jumlah'        =>  $request->jumlah,
            ]);
            DB::commit();
            return redirect()->route('operator.laporan.shu_anggota')->with(['success'    =>'Shu anggota berhasil ditambahkan']);
        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('operator.laporan.shu_anggota')->with(['error'    =>'Shu anggota gagal ditambahkan']);
        }
    }

    public function shuAnggotaUpdate(Request $request,$id){
        $attributes = [
            'anggota_id'    =>  'Nama Anggota',
            'tahun'         =>  'Tahun',
            'shu_jasa'      =>  'Jumlah Shu Jasa',
            'shu_simpanan'  =>  'Jumlah Shu Simpanan',
            'jumlah'        =>  'Jumlah Shu Diterima',
        ];
        $this->validate($request, [
            'anggota_id'    =>'required',
            'tahun'         =>'required',
            'shu_jasa'      =>'required',
            'shu_simpanan'  =>'required',
            'jumlah'        =>'required',
        ],$attributes);
        DB::beginTransaction();
        try {
            $anggota = Anggota::join('jabatans','jabatans.id','anggotas.jabatan_id')
                                ->select('nm_anggota','nm_jabatan')
                                ->where('anggotas.id',$request->anggota_id)->first();
            ShuAnggota::where('id',$id)->update([
                'anggota_id'    =>  $request->anggota_id,
                'jabatan'       =>  $anggota->nm_jabatan,
                'nm_anggota'       =>  $anggota->nm_anggota,
                'tahun'         =>  $request->tahun,
                'shu_jasa'      =>  $request->shu_jasa,
                'shu_simpanan'  =>  $request->shu_simpanan,
                'jumlah'        =>  $request->jumlah,
            ]);

            DB::commit();
            return redirect()->route('operator.laporan.shu_anggota')->with(['success'    =>'Shu anggota berhasil diubah']);
        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('operator.laporan.shu_anggota')->with(['error'    =>'Shu anggota gagal diubah']);
        }
    }

    public function shuAnggotaEdit($id){
        $data = ShuAnggota::find($id);
        $anggotas = Anggota::where('nm_anggota','!=','Koperasi')->get();
        return view('backend/operator/shu.shu_anggota_edit',compact('data','anggotas'));
    }

    public function shuAnggotaDelete($id){
        ShuAnggota::where('id',$id)->delete();
        return redirect()->route('operator.laporan.shu_anggota')->with(['error'    =>'Shu anggota berhasil dihapus']);
    }

    public function generateShu(){
        $tahun = date('Y');
        $keseluruhan = JumlahKeseluruhan::first();
        $pembagian_shu = PembagianShu::where('tahun',$tahun)->first();
        if (empty($pembagian_shu)) {
            return redirect()->back()->with(['error'    =>  'Silahkan Generate Menu Persentase Pembagian SHU Terlebih Dahulu']);
        }

        $datas = Anggota::leftJoin('simpanan_anggotas','simpanan_anggotas.anggota_id','anggotas.id')
                        ->leftJoin('simpanan_jasas','simpanan_jasas.anggota_id','anggotas.id')
                        ->join('jabatans','jabatans.id','anggotas.jabatan_id')
                        ->select('anggotas.id as anggota_id','nm_anggota','nm_jabatan as jabatan','simpanan_anggotas.jumlah as shu_simpanan','simpanan_jasas.jumlah as shu_jasa')
                        ->groupBy('anggotas.id')
                        ->where('anggotas.nm_anggota','!=','Koperasi')
                        ->get();
                        // return $datas[0]['nm_jabatan'];
        $shu_anggota = ShuAnggota::where('tahun',$tahun)->get();
        if (count($shu_anggota)>0) {
            ShuAnggota::where('tahun',$tahun)->delete();
        }
        for ($i=0; $i <count($datas) ; $i++) {
            ShuAnggota::create([
                'anggota_id'    => $datas[$i]['anggota_id'],
                'nm_anggota'    => $datas[$i]['nm_anggota'],
                'jabatan'   =>  $datas[$i]['jabatan'],
                'shu_simpanan'    => ($datas[$i]['shu_simpanan'] /$keseluruhan->jumlah_simpanan_seluruh ) * $pembagian_shu->shu_simpanan,
                'shu_jasa'    => ($datas[$i]['shu_jasa'] /$keseluruhan->jumlah_jasa_seluruh ) * $pembagian_shu->shu_jasa_pinjaman,
                'tahun'     =>  $tahun,
            ]);
        }
        $shus = ShuAnggota::where('tahun',$tahun)->get();
        $jumlah_simpanan = ShuAnggota::select(DB::raw('sum(shu_simpanan) as jumlah'))->first();
        $jumlah_jasa = ShuAnggota::select(DB::raw('sum(shu_jasa) as jumlah'))->first();
        return view('backend/operator.shu.shu_anggota',compact('shus','jumlah_simpanan','jumlah_jasa'))->with(['success'    =>  'SHU Anggota Tahun '.$tahun.' Berhasil Digenerate']);

    }
}
