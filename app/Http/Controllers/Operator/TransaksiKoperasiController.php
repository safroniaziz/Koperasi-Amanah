<?php

namespace App\Http\Controllers\Operator;

use App\Anggota;
use App\Http\Controllers\Controller;
use App\JenisTransaksi;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiKoperasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function index(){
        $koperasis = Transaksi::join('anggotas','anggotas.id','transaksis.anggota_id')
                                ->join('operators','operators.id','transaksis.user_id')
                                ->join('jenis_transaksis','jenis_transaksis.id','transaksis.jenis_transaksi_id')
                                ->select('transaksis.id','nm_transaksi','nm_anggota','nm_operator','jenis_transaksis.jenis_transaksi','jumlah_transaksi','tanggal_transaksi','bulan_transaksi','tahun_transaksi','keterangan')
                                ->where('jenis_transaksi_id','>','4')->get();
        return view('backend/operator/koperasi.index',compact('koperasis'));
    }

    public function add(){
        $anggota = Anggota::where('nm_anggota','Koperasi')->first();
        $jenis_transaksi = JenisTransaksi::where('status_jenis_transaksi','1')->where('id','>','4')->get();
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
        return view('backend/operator/koperasi.add',compact('anggota','bulans','jenis_transaksi'));
    }

    public function post(Request $request){
        $this->validate($request,[
            'anggota_id'    =>  'required',
            'tanggal_transaksi'    =>  'required',
            'bulan_transaksi'    =>  'required',
            'tahun_transaksi'    =>  'required',
            'jumlah_transaksi'    =>  'required',
            'keterangan'    =>  'required',
            'jenis_transaksi_id'    =>  'required',
        ]);
        $jenis_transaksi = JenisTransaksi::where('id',$request->jenis_transaksi_id)->first();
        Transaksi::create([
            'jenis_transaksi_id'    =>  $request->jenis_transaksi_id,
            'anggota_id'    =>  $request->anggota_id,
            'user_id'   =>  Auth::guard('operator')->user()->id,
            'jumlah_transaksi'  =>  $request->jumlah_transaksi,
            'tanggal_transaksi' =>  $request->tanggal_transaksi,
            'bulan_transaksi'   =>  $request->bulan_transaksi,
            'tahun_transaksi'   =>  $request->tahun_transaksi,
            'keterangan'   =>  $request->keterangan,
            'jenis_transaksi'   =>  $jenis_transaksi->jenis_transaksi,
        ]);

        return redirect()->route('operator.transaksi_koperasi')->with(['success'    =>  'Transaksi Transaksi Koperasi Berhasil Ditambahkan !!']);
    }

    public function edit($id){
        $koperasi = Transaksi::find($id);
        $anggota = Anggota::where('nm_anggota','Koperasi')->first();
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
        return view('backend/operator/koperasi.edit',compact('koperasi','anggota','bulans'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'anggota_id'    =>  'required',
            'tanggal_transaksi'    =>  'required',
            'bulan_transaksi'    =>  'required',
            'tahun_transaksi'    =>  'required',
            'jumlah_transaksi'    =>  'required',
            'keterangan'    =>  'required',
        ]);

        Transaksi::where('id',$request->transaksi_id)->update([
            'jumlah_transaksi'  =>  $request->jumlah_transaksi,
            'tanggal_transaksi' =>  $request->tanggal_transaksi,
            'bulan_transaksi'   =>  $request->bulan_transaksi,
            'tahun_transaksi'   =>  $request->tahun_transaksi,
            'keterangan'   =>  $request->keterangan,
        ]);

        return redirect()->route('operator.transaksi_koperasi')->with(['success'    =>  'Transaksi Koperasi Berhasil Diubah !!']);
    }

    public function delete($id){
        $galeri = Transaksi::find($id);
        $galeri->delete();

        return redirect()->route('operator.transaksi_koperasi')->with(['success'    =>  'Data transaksi baru sudah dihapus !']);
    }
}
