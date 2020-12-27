<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function index() {
        $profils = Profil::all();
        return view('backend/operator/profil.index',compact('profils'));
    }

    public function post(Request $request) {
        $model = $request->all();
        $model['foto'] = null;

        if ($request->hasFile('foto')){
            $model['foto'] = '/upload/foto_lembaga/'.Str::slug($model['telephone'], '-').'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('/upload/foto_lembaga/'), $model['foto']);
        }


        $profil =new Profil;
        $profil->alamat_lengkap = $request->alamat_lengkap;
        $profil->visi = $request->visi;
        $profil->misi = $request->misi;
        $profil->telephone = $request->telephone;
        $profil->email = $request->email;
        $profil->facebook = $request->facebook;
        $profil->instagram = $request->instagram;
        $profil->jumlah_anggota = $request->jumlah_anggota;
        $profil->jumlah_pengurus = $request->jumlah_pengurus;
        $profil->tahun_berdiri = $request->tahun_berdiri;
        $profil->kerja_sama = $request->kerja_sama;
        $profil->foto = $model['foto'];
        $profil->save();

        return redirect()->route('operator.profil')->with(['success' =>  'profil baru berhasil ditambahkan !']);
    }

    public function edit($id) {
        $profil= Profil::find($id);

        return $profil;
    }

    public function update(Request $request) {
        $profil = Profil::find($request->id);

        $model = $request->all();
        $model['foto'] = $profil->foto;
        if ($request->hasFile('foto')){
            if (!$profil->foto == NULL){
                unlink(public_path($profil->foto));
            }
            $model['foto'] = '/upload/foto_lembaga/'.Str::slug($model['nm_lembaga'], '-').'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('/upload/foto_lembaga/'), $model['foto']);
        }

        $profil->alamat_lengkap = $request->alamat_lengkap;
        $profil->visi = $request->visi;
        $profil->misi = $request->misi_edit;
        $profil->telephone = $request->telephone;
        $profil->email = $request->email;
        $profil->facebook = $request->facebook;
        $profil->instagram = $request->instagram;
        $profil->jumlah_anggota = $request->jumlah_anggota;
        $profil->jumlah_pengurus = $request->jumlah_pengurus;
        $profil->tahun_berdiri = $request->tahun_berdiri;
        $profil->kerja_sama = $request->kerja_sama;
        $profil->foto = $model['foto'];
        $profil->update();

        return redirect()->route('operator.profil')->with(['success' =>  'profil baru berhasil diubah !']);
    }
}
