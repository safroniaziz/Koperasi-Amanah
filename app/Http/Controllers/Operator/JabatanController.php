<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    
    public function index(){
        $jabatans = Jabatan::all();
        return view('backend/operator/jabatan.index',compact('jabatans'));
    }

    public function post(Request $request){
        $this->validate($request, [
            'nm_jabatan'  =>  'required',
        ]);

        Jabatan::create([
            'nm_jabatan'  =>  $request->nm_jabatan,
        ]);

        return redirect()->route('operator.jabatan')->with(['success'   =>  'Data Jabatan Berhasil Ditambahkan !!']);
    }

    public function aktifkanStatus($id){
        Jabatan::where('id',$id)->update([
            'status_jabatan'    =>  '1'
        ]);
        return redirect()->route('operator.jabatan')->with(['success' =>  'Data Jabatan Berhasil Di Aktifkan !!']);
    }

    public function nonaktifkanStatus($id){
        Jabatan::where('id',$id)->update([
            'status_jabatan'    =>  '0'
        ]);
        return redirect()->route('operator.jabatan')->with(['success' =>  'Data Jabatan Berhasil Di Nonaktifkan !!']);
    }

    public function edit($id){
        $data = Jabatan::find($id);
        return $data;
    }

    public function update(Request $request){
        $this->validate($request, [
            'nm_jabatan'  =>  'required',
        ]);

        Jabatan::where('id',$request->id)->update([
            'nm_jabatan'  =>  $request->nm_jabatan,
        ]);

        return redirect()->route('operator.jabatan')->with(['success'   =>  'Data Jabatan Berhasil Diubah !!']);
    }
}
