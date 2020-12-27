<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\JenisTransaksi;
use Illuminate\Http\Request;

class JenisTransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    
    public function index(){
        $jenis_transaksis = JenisTransaksi::all();
        return view('backend/operator/jenis_transaksi.index',compact('jenis_transaksis'));
    }

    public function post(Request $request){
        $this->validate($request, [
            'nm_transaksi'  =>  'required',
            'jenis_transaksi'  =>  'required',
        ]);

        JenisTransaksi::create([
            'nm_transaksi'  =>  $request->nm_transaksi,
            'jenis_transaksi'  =>  $request->jenis_transaksi,
            'slug'          => \Str::slug($request->nm_transaksi),
        ]);

        return redirect()->route('operator.jenis_transaksi')->with(['success'   =>  'Jenis Transaksi Berhasil Ditambahkan !!']);
    }

    public function aktifkanStatus($id){
        JenisTransaksi::where('id',$id)->update([
            'status_jenis_transaksi'    =>  '1'
        ]);
        return redirect()->route('operator.jenis_transaksi')->with(['success' =>  'Jenis Transaksi Berhasil Di Aktifkan !!']);
    }

    public function nonaktifkanStatus($id){
        JenisTransaksi::where('id',$id)->update([
            'status_jenis_transaksi'    =>  '0'
        ]);
        return redirect()->route('operator.jenis_transaksi')->with(['success' =>  'Jenis Transaksi Berhasil Di Nonaktifkan !!']);
    }

    public function edit($id){
        $data = JenisTransaksi::find($id);
        return $data;
    }

    public function update(Request $request){
        $this->validate($request, [
            'nm_transaksi'  =>  'required',
            'jenis_transaksi'  =>  'required',
        ]);

        JenisTransaksi::where('id',$request->id)->update([
            'nm_transaksi'  =>  $request->nm_transaksi,
            'jenis_transaksi'  =>  $request->jenis_transaksi,
            'slug'          => \Str::slug($request->nm_transaksi),
        ]);

        return redirect()->route('operator.jenis_transaksi')->with(['success'   =>  'Jenis Transaksi Berhasil Diubah !!']);
    }
}
