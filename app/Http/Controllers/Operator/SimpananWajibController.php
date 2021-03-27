<?php

namespace App\Http\Controllers\Operator;

use App\Anggota;
use App\Http\Controllers\Controller;
use App\JenisTransaksi;
use App\Operator;
use App\Transaksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SimpananWajibController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    
    public function index(){
        $simpanan_wajibs = Transaksi::join('jenis_transaksis','jenis_transaksis.id','transaksis.jenis_transaksi_id')
                                        ->leftJoin('anggotas','anggotas.id','transaksis.anggota_id')
                                        ->select('transaksis.id','nm_anggota','tanggal_transaksi','bulan_transaksi','tahun_transaksi','jumlah_transaksi','nm_operator')
                                        ->join('operators','operators.id','transaksis.user_id')
                                        ->where('jenis_transaksis.id','1')->get();
                                        // return $simpanan_wajibs;
        $jenis_transaksis = JenisTransaksi::select('nm_transaksi','jenis_transaksi')->where('status_jenis_transaksi','1')->get();
        return view('backend/operator/simpanan_wajib.index',compact('simpanan_wajibs','jenis_transaksis'));
    }

    public function add(){
        $anggotas = Anggota::where('status_anggota','1')->get();
        $tahun = date("Y");
        return view('backend/operator/simpanan_wajib.add',compact('anggotas','tahun'));
    }

    public function post(Request $request){
        $this->validate($request,[
            'anggota_id'    =>  'required',
            'jumlah_transaksi'    =>  'required',
            'tanggal_transaksi'    =>  'required',
            'bulan_transaksi'    =>  'required',
            'tahun_transaksi'    =>  'required',
        ]);

        DB::beginTransaction();
        try {
            Transaksi::create([
                'jenis_transaksi_id'    =>  1,
                'anggota_id'    =>  $request->anggota_id,
                'user_id'   =>  Auth::guard('operator')->user()->id,
                'jumlah_transaksi'  =>  $request->jumlah_transaksi,
                'tanggal_transaksi' =>  $request->tanggal_transaksi,
                'bulan_transaksi'   =>  $request->bulan_transaksi,
                'tahun_transaksi'   =>  $request->tahun_transaksi,
                'jenis_transaksi'   =>  'masuk',
            ]);
            DB::commit();
            return redirect()->route('operator.simpanan_wajib')->with(['success' =>  'Transaksi Simpanan Wajib Berhasil Ditambahkan !!']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('operator.simpanan_wajib.add')->with(['error' =>  'Transaksi Simpanan Gagal Berhasil Ditambahkan !!']);
        }


        return redirect()->route('operator.simpanan_wajib')->with(['success'    =>  'Transaksi Simpanan Wajib Berhasil Ditambahkan !!']);
    }

    public function cariBulan(Request $request){
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
        $tahun = date("Y");
        
        $bulan = Transaksi::where('anggota_id',$request->anggota_id)->select('bulan_transaksi')->where('tahun_transaksi',$tahun)->pluck('bulan_transaksi')->toArray();
        $bulan2 = [
            'bulan' =>  $bulan
        ];
        if (count($bulan)>0) {
            $datas = [];
            for ($i=0; $i <count($bulans) ; $i++) { 
                    if (!in_array($bulans[$i]['bulan_transaksi'],$bulan, true)) {
                        $datas[]    =   [
                            'bulan_transaksi'   =>  $bulans[$i]['bulan_transaksi'],
                        ];
                    }
            }
            return $datas;
        }
        else{
            return $bulans;
        }
    }

    public function edit($id){
        $transaksi = Transaksi::find($id);
        $jenis_transaksis = JenisTransaksi::where('status_jenis_transaksi','1')->get();
        $anggotas = Anggota::where('status_anggota','1')->where('id',$transaksi->anggota_id)->get();

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
        $tahun = date("Y");
        
        $bulan = Transaksi::where('anggota_id',$transaksi->anggota_id)->select('bulan_transaksi')->where('bulan_transaksi','!=',$transaksi->bulan_transaksi)->where('tahun_transaksi',$tahun)->pluck('bulan_transaksi')->toArray();
        $bulan2 = [
            'bulan' =>  $bulan
        ];
        if (count($bulan)>0) {
            $datas = [];
            for ($i=0; $i <count($bulans) ; $i++) { 
                        if (!in_array($bulans[$i]['bulan_transaksi'],$bulan, true)) {
                            $datas[]    =   [
                                'bulan_transaksi'   =>  $bulans[$i]['bulan_transaksi'],
                            ];
                        }
            }
            $bulans = $datas;
        } 
        else{
            $bulans = $bulans;
        }
        return view('backend/operator/simpanan_wajib.edit',compact('transaksi','jenis_transaksis','anggotas','bulans'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'anggota_id'    =>  'required',
            'jumlah_transaksi'    =>  'required',
            'tanggal_transaksi'    =>  'required',
            'bulan_transaksi'    =>  'required',
            'tahun_transaksi'    =>  'required',
        ]);

        Transaksi::where('id',$request->id)->update([
            'tanggal_transaksi' =>  $request->tanggal_transaksi,
            'bulan_transaksi'   =>  $request->bulan_transaksi,
            'tahun_transaksi'   =>  $request->tahun_transaksi,
        ]);

        return redirect()->route('operator.simpanan_wajib')->with(['success'    =>  'Transaksi Simpanan Wajib Berhasil Diubah !!']);
    }
}
