<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\JenisTransaksi;
use App\Pinjaman;
use App\Transaksi;
use App\TransaksiPinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AngsuranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function index(){
        $angsurans = Transaksi::join('anggotas','anggotas.id','transaksis.anggota_id')
                                ->join('operators','operators.id','transaksis.user_id')
                                ->join('jenis_transaksis','jenis_transaksis.id','transaksis.jenis_transaksi_id')
                                ->whereIn('jenis_transaksi_id',[3,4])->get();
        return view('backend/operator/angsuran.index',compact('angsurans'));
    }

    public function add(){
        $anggotas = TransaksiPinjaman::join('pinjamen','pinjamen.id','transaksi_pinjamen.pinjaman_id')
                                            ->join('anggotas','anggotas.id','pinjamen.anggota_id')
                                            ->select('anggotas.id as anggota_id','nm_anggota','jumlah_angsuran_pokok','jumlah_angsuran_bunga')
                                            ->groupBy('anggota_id')
                                            ->get();
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
        return view('backend/operator/angsuran.add',compact('anggotas','bulans'));
    }

    public function cariAngsuran(Request $request){
        $angsuran = Pinjaman::where('anggota_id',$request->anggota_id)->first();

        $bulan_mulai = $angsuran->bulan_mulai_angsuran;
        $tahun_mulai = $angsuran->tahun_mulai_angsuran;
        $bulan_akhir = $angsuran->bulan_akhir_angsuran;
        $tahun_akhir = $angsuran->tahun_akhir_angsuran;
        
        if ($request->jumlah_bulan == "12") {
            $tahun_akhir = $request->tahun_mulai_angsuran +1;
        }
        else{
            $tahun_akhir = $request->tahun_mulai_angsuran +2;
        }

        return $angsuran;
    }

    public function post(Request $request){
        $this->validate($request,[
            'anggota_id'    =>  'required',
            'tanggal_transaksi'    =>  'required',
            'bulan_transaksi'    =>  'required',
            'tahun_transaksi'    =>  'required',
            'jumlah_angsuran_pokok'    =>  'required',
            'jumlah_angsuran_bunga'    =>  'required',
        ]);

        $jenis_transaksi = JenisTransaksi::where('id',3)->first();

        Transaksi::create([
            'jenis_transaksi_id'    =>  3,
            'anggota_id'    =>  $request->anggota_id,
            'user_id'   =>  Auth::guard('operator')->user()->id,
            'jumlah_transaksi'  =>  $request->jumlah_angsuran_pokok,
            'tanggal_transaksi' =>  $request->tanggal_transaksi,
            'bulan_transaksi'   =>  $request->bulan_transaksi,
            'tahun_transaksi'   =>  $request->tahun_transaksi,
            'jenis_transaksi'   =>  $jenis_transaksi->jenis_transaksi,
        ]);
        $jenis_transaksi2 = JenisTransaksi::where('id',4)->first();

        Transaksi::create([
            'jenis_transaksi_id'    =>  4,
            'anggota_id'    =>  $request->anggota_id,
            'user_id'   =>  Auth::guard('operator')->user()->id,
            'jumlah_transaksi'  =>  $request->jumlah_angsuran_bunga,
            'tanggal_transaksi' =>  $request->tanggal_transaksi,
            'bulan_transaksi'   =>  $request->bulan_transaksi,
            'tahun_transaksi'   =>  $request->tahun_transaksi,
            'jenis_transaksi'   =>  $jenis_transaksi2->jenis_transaksi,
        ]);

        return redirect()->route('operator.transaksi_angsuran')->with(['success' =>  'Transaksi Angsuran Berhasil Ditambahkan !!']);
    }
}
