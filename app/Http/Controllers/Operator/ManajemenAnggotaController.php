<?php

namespace App\Http\Controllers\Operator;

use App\Anggota;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManajemenAnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    
    public function index(){
        $anggotas = Anggota::all();
        return view('backend/operator/anggota.index',compact('anggotas'));
    }

    public function post(Request $request){
        $model = $request->all();
        $this->validate($request, [
            'nm_anggota'  =>  'required',
            'nik'  =>  'required',
            'alamat'  =>  'required',
            'tahun_keanggotaan'  =>  'required',
            'email'  =>  'required|email',
            'password'  =>  'required',
            'foto'    =>  'required',
        ]);

        $model['foto'] = null;

        if ($request->hasFile('foto')){
            $model['foto'] = '/upload/foto_anggota/'.Str::slug($model['nm_anggota'], '-').'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('/upload/foto_anggota/'), $model['foto']);
            Anggota::create([
                'nm_anggota'  =>  $request->nm_anggota,
                'nik'    =>  $request->nik,
                'alamat'    =>  $request->alamat,
                'tahun_keanggotaan'    =>  $request->tahun_keanggotaan,
                'status_anggota'    =>  '1',
                'email'    =>  $request->email,
                'password'    =>  bcrypt($request->password),
                'gambar'    =>  $model['foto'],
            ]);
        }
        else{
            Anggota::create([
                'nm_anggota'  =>  $request->nm_anggota,
                'nik'    =>  $request->nik,
                'alamat'    =>  $request->alamat,
                'tahun_keanggotaan'    =>  $request->tahun_keanggotaan,
                'status_anggota'    =>  '1',
                'email'    =>  $request->email,
                'password'    =>  bcrypt($request->password),
            ]);
        }
        

        return redirect()->route('operator.manajemen_anggota')->with(['success'   =>  'Data Anggota Baru Berhasil Ditambahkan !!']);
    }

    public function aktifkanStatus($id){
        Anggota::where('id',$id)->update([
            'status_anggota'    =>  '1'
        ]);
        return redirect()->route('operator.manajemen_anggota')->with(['success' =>  'Status Anggota Berhasil Di Aktifkan !!']);
    }

    public function nonaktifkanStatus($id){
        Anggota::where('id',$id)->update([
            'status_anggota'    =>  '0'
        ]);
        return redirect()->route('operator.manajemen_anggota')->with(['success' =>  'Status Anggota Berhasil Di Nonaktifkan !!']);
    }

    public function edit($id){
        $data = Anggota::find($id);
        return $data;
    }

    public function update(Request $request){
        $this->validate($request, [
            'nm_anggota'  =>  'required',
            'nik'  =>  'required',
            'alamat'  =>  'required',
            'tahun_keanggotaan'  =>  'required',
            'email'  =>  'required|email',
        ]);
        $anggota = Anggota::find($request->id);


        $model = $request->all();
        $model['foto'] = $anggota->foto;
        if ($request->hasFile('foto')){
            if (!$anggota->foto == NULL){
                unlink(public_path($anggota->foto));
            }
            $model['foto'] = '/upload/foto_anggota/'.Str::slug($model['nm_anggota'], '-').'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('/upload/foto_anggota/'), $model['foto']);
        }

        Anggota::where('id',$request->id)->update([
            'nm_anggota'  =>  $request->nm_anggota,
            'nik'    =>  $request->nik,
            'alamat'    =>  $request->alamat,
            'tahun_keanggotaan'    =>  $request->tahun_keanggotaan,
            'email'    =>  $request->email,
            'gambar'    =>  $model['foto'],
        ]);

        return redirect()->route('operator.manajemen_anggota')->with(['success'   =>  'Data Anggota Berhasil Diubah !!']);
    }

    public function delete(Request $request){
        Anggota::where('id',$request->id)->delete();
        return redirect()->route('operator.manajemen_anggota')->with(['success'   =>  'Data Anggota Berhasil Dihapus !!']);
    }

    public function updatePassword(Request $request){
        Anggota::where('id',$request->id)->update([
            'password'  =>  bcrypt($request->password_baru),
        ]);

        return redirect()->route('operator.manajemen_anggota')->with(['success'   =>  'Password Anggota Berhasil Diubah !!']);
    }
}
