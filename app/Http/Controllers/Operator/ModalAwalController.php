<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CatatanBulan;

class ModalAwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function index(){
        $modal_awals = CatatanBulan::orderBy('id','desc')->get();
        return view('backend/operator/laporan/modal_awal',compact('modal_awals'));
    }

    public function post(Request $request){
        $this->validate($request, [
            'tahun'  =>  'required',
            'bulan'  =>  'required',
            'modal_awal'  =>  'required',
        ]);

        CatatanBulan::create([
            'tahun'  =>  $request->tahun,
            'bulan'  =>  $request->bulan,
            'modal_awal'  =>  $request->modal_awal,
        ]);

        return redirect()->route('operator.modal_awal')->with(['success'   =>  'Modal Awal Berhasil Ditambahkan !!']);
    }

    public function delete($id){
        CatatanBulan::destroy($id);
        return redirect()->route('operator.modal_awal')->with(['success'   =>  'Modal Awal Berhasil Dihapus !!']);
    }
}
