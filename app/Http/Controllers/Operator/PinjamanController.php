<?php

namespace App\Http\Controllers\Operator;

use App\Anggota;
use App\Http\Controllers\Controller;
use App\JenisTransaksi;
use App\Pinjaman;
use App\Transaksi;
use App\TransaksiPinjaman;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PinjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    
    public function index(){
        $pinjamans = TransaksiPinjaman::join('transaksis','transaksis.id','transaksi_pinjamen.transaksi_id')
                                        ->join('pinjamen','pinjamen.id','transaksi_pinjamen.pinjaman_id')
                                        ->join('anggotas','anggotas.id','transaksis.anggota_id')
                                        ->join('operators','operators.id','transaksis.user_id')
                                        ->select('transaksi_pinjamen.id','nm_anggota','jumlah_pinjaman','jumlah_bulan','bunga','jumlah_angsuran_pokok',
                                                    'jumlah_angsuran_bunga','bulan_mulai_angsuran','tahun_mulai_angsuran','bulan_akhir_angsuran','tahun_akhir_angsuran','nm_operator')
                                        ->get();
        return view('backend/operator/pinjaman.index',compact('pinjamans'));
    }
    
    public function add(){
        $anggotas = Anggota::where('status_anggota','1')->get();
        $tahun = date("Y");
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
        return view('backend/operator/pinjaman.add',compact('anggotas','tahun','bulans'));
    }

    public function post(Request $request){
        $this->validate($request,[
            'anggota_id'    =>  'required',
            'tanggal_transaksi'    =>  'required',
            'bulan_transaksi'    =>  'required',
            'tahun_transaksi'    =>  'required',
            'bunga'    =>  'required',
            'jumlah_angsuran_pokok'    =>  'required',
            'jumlah_angsuran_bunga'    =>  'required',
            'bunga'    =>  'required',
            'bulan_mulai_angsuran'    =>  'required',
            'tahun_mulai_angsuran'    =>  'required',
        ]);
        $bulans = [
            ['no' =>  '1' , 'bulan' =>  'Januari'],
            ['no' =>  '2' , 'bulan' =>  'Februari'],
            ['no' =>  '3' , 'bulan' =>  'Maret'],
            ['no' =>  '4' , 'bulan' =>  'April'],
            ['no' =>  '5' , 'bulan' =>  'Mei'],
            ['no' =>  '6' , 'bulan' =>  'Juni'],
            ['no' =>  '7' , 'bulan' =>  'Juli'],
            ['no' =>  '8' , 'bulan' =>  'Agustus'],
            ['no' =>  '9' , 'bulan' =>  'September'],
            ['no' =>  '10', 'bulan'  =>  'Oktober'],
            ['no' =>  '11', 'bulan'  =>  'November'],
            ['no' =>  '12', 'bulan'  =>  'Desember'],
            ['no' =>  '13', 'bulan'  =>  'Januari'],
            ['no' =>  '14', 'bulan'  =>  'Februari'],
            ['no' =>  '15', 'bulan'  =>  'Maret'],
            ['no' =>  '16', 'bulan'  =>  'April'],
            ['no' =>  '17', 'bulan'  =>  'Mei'],
            ['no' =>  '18', 'bulan'  =>  'Juni'],
            ['no' =>  '19', 'bulan'  =>  'Juli'],
            ['no' =>  '20', 'bulan'  =>  'Agustus'],
            ['no' =>  '21', 'bulan'  =>  'September'],
            ['no' =>  '22', 'bulan'  =>  'Oktober'],
            ['no' =>  '23', 'bulan'  =>  'November'],
            ['no' =>  '24', 'bulan'  =>  'Desember'],
            ['no' =>  '24', 'bulan'  =>  'Januari'],
            ['no' =>  '25', 'bulan'  =>  'Februari'],
            ['no' =>  '26', 'bulan'  =>  'Maret'],
            ['no' =>  '27', 'bulan'  =>  'April'],
            ['no' =>  '28', 'bulan'  =>  'Mei'],
            ['no' =>  '29', 'bulan'  =>  'Juni'],
            ['no' =>  '30', 'bulan'  =>  'Juli'],
            ['no' =>  '31', 'bulan'  =>  'Agustus'],
            ['no' =>  '32', 'bulan'  =>  'September'],
            ['no' =>  '33', 'bulan'  =>  'Oktober'],
            ['no' =>  '34', 'bulan'  =>  'November'],
            ['no' =>  '35', 'bulan'  =>  'Desember'],
            ['no' =>  '36', 'bulan'  =>  'Desember'],
        ];
        if ($request->bulan_mulai_angsuran == "Januari") {
            $mulai = 1;
        } elseif ($request->bulan_mulai_angsuran == "Februari") {
            $mulai = 2;
        }elseif ($request->bulan_mulai_angsuran == "Maret") {
            $mulai = 3;
        }elseif ($request->bulan_mulai_angsuran == "April") {
            $mulai = 4;
        }elseif ($request->bulan_mulai_angsuran == "Mei") {
            $mulai = 5;
        }elseif ($request->bulan_mulai_angsuran == "Juni") {
            $mulai = 6;
        }elseif ($request->bulan_mulai_angsuran == "Juli") {
            $mulai = 7;
        }elseif ($request->bulan_mulai_angsuran == "Agustus") {
            $mulai = 8;
        }elseif ($request->bulan_mulai_angsuran == "September") {
            $mulai = 9;
        }elseif ($request->bulan_mulai_angsuran == "Oktober") {
            $mulai = 10;
        }elseif ($request->bulan_mulai_angsuran == "November") {
            $mulai = 11;
        }elseif ($request->bulan_mulai_angsuran == "Desember") {
            $mulai = 12;
        }
        $bulan = ($mulai + $request->jumlah_bulan)-1;

        for ($i=0; $i < count($bulans); $i++) { 
            if ($bulans[$i]['no']   == $bulan) {
                $month = $bulans[$i]['bulan'];
            }
        }
        if ($request->jumlah_bulan == "12") {
            $tahun_akhir = $request->tahun_mulai_angsuran +1;
        }
        else{
            $tahun_akhir = $request->tahun_mulai_angsuran +2;
        }
        $jenis_transaksi = JenisTransaksi::where('id',2)->first();
        DB::beginTransaction();
        try {
            
            Transaksi::create([
                'jenis_transaksi_id'    =>  2,
                'anggota_id'    =>  $request->anggota_id,
                'user_id'   =>  Auth::guard('operator')->user()->id,
                'jumlah_transaksi'  =>  $request->jumlah_transaksi,
                'tanggal_transaksi' =>  $request->tanggal_transaksi,
                'bulan_transaksi'   =>  $request->bulan_transaksi,
                'tahun_transaksi'   =>  $request->tahun_transaksi,
                'jenis_transaksi'   =>  $jenis_transaksi->jenis_transaksi,
            ]);

            Pinjaman::create([
                'anggota_id'    =>  $request->anggota_id,
                'user_id'   =>  Auth::guard('operator')->user()->id,
                'jumlah_pinjaman'  =>  $request->jumlah_transaksi,
                'bunga'  =>  $request->bunga,
                'jumlah_angsuran_pokok'  =>  $request->jumlah_angsuran_pokok,
                'jumlah_angsuran_bunga'  =>  $request->jumlah_angsuran_bunga,
                'bulan_mulai_angsuran'  =>  $request->bulan_mulai_angsuran,
                'tahun_mulai_angsuran'  =>  $request->tahun_mulai_angsuran,
                'bulan_akhir_angsuran'  =>  $month,
                'tahun_akhir_angsuran'  =>  $tahun_akhir,
                'status_pinjaman'  =>  "belum",
                'jumlah_bulan'  =>  $request->jumlah_bulan,

            ]);

            TransaksiPinjaman::create([
                'transaksi_id'  =>  Transaksi::max('id'),
                'pinjaman_id'  =>  Pinjaman::max('id'),
            ]);
            DB::commit();
            return redirect()->route('operator.pinjaman')->with(['success' =>  'Transaksi Pinjaman Berhasil Ditambahkan !!']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('operator.pinjaman.add')->with(['error' =>  'Transaksi Pinjaman Gagal Berhasil Ditambahkan !!']);
        }
    }

    public function edit($id){
        $transaksi = TransaksiPinjaman::join('transaksis','transaksis.id','transaksi_pinjamen.transaksi_id')
                    ->join('pinjamen','pinjamen.id','transaksi_pinjamen.pinjaman_id')
                    ->join('anggotas','anggotas.id','transaksis.anggota_id')
                    ->join('operators','operators.id','transaksis.user_id')
                    ->select('transaksi_pinjamen.id','transaksi_pinjamen.pinjaman_id','transaksi_pinjamen.transaksi_id','transaksis.anggota_id','jumlah_pinjaman','jumlah_bulan','bunga','jumlah_angsuran_pokok',
                                'jumlah_angsuran_bunga','bulan_mulai_angsuran','tanggal_transaksi','bulan_transaksi','tahun_transaksi','tahun_mulai_angsuran','bulan_akhir_angsuran','tahun_akhir_angsuran','nm_operator')
                    ->where('transaksi_pinjamen.id',$id)            
                    ->first();
        $anggotas = Anggota::where('status_anggota','1')->get();
        $tahun = date("Y");
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
        return view('backend/operator/pinjaman.edit',compact('transaksi','anggotas','bulans','tahun'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'anggota_id'    =>  'required',
            'tanggal_transaksi'    =>  'required',
            'bulan_transaksi'    =>  'required',
            'tahun_transaksi'    =>  'required',
            'bunga'    =>  'required',
            'jumlah_angsuran_pokok'    =>  'required',
            'jumlah_angsuran_bunga'    =>  'required',
            'bunga'    =>  'required',
            'bulan_mulai_angsuran'    =>  'required',
            'tahun_mulai_angsuran'    =>  'required',
        ]);
        $bulans = [
            ['no' =>  '1' , 'bulan' =>  'Januari'],
            ['no' =>  '2' , 'bulan' =>  'Februari'],
            ['no' =>  '3' , 'bulan' =>  'Maret'],
            ['no' =>  '4' , 'bulan' =>  'April'],
            ['no' =>  '5' , 'bulan' =>  'Mei'],
            ['no' =>  '6' , 'bulan' =>  'Juni'],
            ['no' =>  '7' , 'bulan' =>  'Juli'],
            ['no' =>  '8' , 'bulan' =>  'Agustus'],
            ['no' =>  '9' , 'bulan' =>  'September'],
            ['no' =>  '10', 'bulan'  =>  'Oktober'],
            ['no' =>  '11', 'bulan'  =>  'November'],
            ['no' =>  '12', 'bulan'  =>  'Desember'],
            ['no' =>  '13', 'bulan'  =>  'Januari'],
            ['no' =>  '14', 'bulan'  =>  'Februari'],
            ['no' =>  '15', 'bulan'  =>  'Maret'],
            ['no' =>  '16', 'bulan'  =>  'April'],
            ['no' =>  '17', 'bulan'  =>  'Mei'],
            ['no' =>  '18', 'bulan'  =>  'Juni'],
            ['no' =>  '19', 'bulan'  =>  'Juli'],
            ['no' =>  '20', 'bulan'  =>  'Agustus'],
            ['no' =>  '21', 'bulan'  =>  'September'],
            ['no' =>  '22', 'bulan'  =>  'Oktober'],
            ['no' =>  '23', 'bulan'  =>  'November'],
            ['no' =>  '24', 'bulan'  =>  'Desember'],
            ['no' =>  '24', 'bulan'  =>  'Januari'],
            ['no' =>  '25', 'bulan'  =>  'Februari'],
            ['no' =>  '26', 'bulan'  =>  'Maret'],
            ['no' =>  '27', 'bulan'  =>  'April'],
            ['no' =>  '28', 'bulan'  =>  'Mei'],
            ['no' =>  '29', 'bulan'  =>  'Juni'],
            ['no' =>  '30', 'bulan'  =>  'Juli'],
            ['no' =>  '31', 'bulan'  =>  'Agustus'],
            ['no' =>  '32', 'bulan'  =>  'September'],
            ['no' =>  '33', 'bulan'  =>  'Oktober'],
            ['no' =>  '34', 'bulan'  =>  'November'],
            ['no' =>  '35', 'bulan'  =>  'Desember'],
            ['no' =>  '36', 'bulan'  =>  'Desember'],
        ];
        if ($request->bulan_mulai_angsuran == "Januari") {
            $mulai = 1;
        } elseif ($request->bulan_mulai_angsuran == "Februari") {
            $mulai = 2;
        }elseif ($request->bulan_mulai_angsuran == "Maret") {
            $mulai = 3;
        }elseif ($request->bulan_mulai_angsuran == "April") {
            $mulai = 4;
        }elseif ($request->bulan_mulai_angsuran == "Mei") {
            $mulai = 5;
        }elseif ($request->bulan_mulai_angsuran == "Juni") {
            $mulai = 6;
        }elseif ($request->bulan_mulai_angsuran == "Juli") {
            $mulai = 7;
        }elseif ($request->bulan_mulai_angsuran == "Agustus") {
            $mulai = 8;
        }elseif ($request->bulan_mulai_angsuran == "September") {
            $mulai = 9;
        }elseif ($request->bulan_mulai_angsuran == "Oktober") {
            $mulai = 10;
        }elseif ($request->bulan_mulai_angsuran == "November") {
            $mulai = 11;
        }elseif ($request->bulan_mulai_angsuran == "Desember") {
            $mulai = 12;
        }
        $bulan = ($mulai + $request->jumlah_bulan)-1;

        for ($i=0; $i < count($bulans); $i++) { 
            if ($bulans[$i]['no']   == $bulan) {
                $month = $bulans[$i]['bulan'];
            }
        }
        if ($request->jumlah_bulan == "12") {
            $tahun_akhir = $request->tahun_mulai_angsuran +1;
        }
        else{
            $tahun_akhir = $request->tahun_mulai_angsuran +2;
        }
        $jenis_transaksi = JenisTransaksi::where('id',2)->first();
        DB::beginTransaction();
        try {
            
            Transaksi::where('id',$request->transaksi_id)->update([
                'anggota_id'    =>  $request->anggota_id,
                'jumlah_transaksi'  =>  $request->jumlah_transaksi,
                'tanggal_transaksi' =>  $request->tanggal_transaksi,
                'bulan_transaksi'   =>  $request->bulan_transaksi,
                'tahun_transaksi'   =>  $request->tahun_transaksi,
                'jenis_transaksi'   =>  $jenis_transaksi->jenis_transaksi,
            ]);

            Pinjaman::where('id',$request->pinjaman_id)->update([
                'anggota_id'    =>  $request->anggota_id,
                'jumlah_pinjaman'  =>  $request->jumlah_transaksi,
                'bunga'  =>  $request->bunga,
                'jumlah_angsuran_pokok'  =>  $request->jumlah_angsuran_pokok,
                'jumlah_angsuran_bunga'  =>  $request->jumlah_angsuran_bunga,
                'bulan_mulai_angsuran'  =>  $request->bulan_mulai_angsuran,
                'tahun_mulai_angsuran'  =>  $request->tahun_mulai_angsuran,
                'bulan_akhir_angsuran'  =>  $month,
                'tahun_akhir_angsuran'  =>  $tahun_akhir,
                'status_pinjaman'  =>  "belum",
                'jumlah_bulan'  =>  $request->jumlah_bulan,

            ]);

            DB::commit();
            return redirect()->route('operator.pinjaman')->with(['success' =>  'Transaksi Pinjaman Berhasil Ditambahkan !!']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('operator.pinjaman.add')->with(['error' =>  'Transaksi Pinjaman Gagal Berhasil Ditambahkan !!']);
        }
    }
}
