<?php

namespace App\Http\Controllers\Operator;

use App\Berita;
use App\Http\Controllers\Controller;
use App\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function index() {
        $beritas = Berita::select('id','judul','isi','gambar','created_at')->get();
        return view('backend/operator/berita.index',compact('beritas'));
    }

    public function post(Request $request) {
        $model = $request->all();
        $model['gambar'] = null;

        if ($request->hasFile('gambar')){
            $model['gambar'] = '/upload/gambar_berita/'.Str::slug($model['judul'], '-').'.'.$request->gambar->getClientOriginalExtension();
            $request->gambar->move(public_path('/upload/gambar_berita/'), $model['gambar']);
            $berita =new Berita;
            $berita->judul = $request->judul;
            $berita->isi = $request->isi;
            $berita->gambar = $model['gambar'];
            $berita->user_id    =   Auth::guard('operator')->user()->id;
            $berita->slug = \Str::slug($request->judul);
            $berita->save();
        }
        else{
            $berita =new Berita;
            $berita->judul = $request->judul;
            $berita->isi = $request->isi;
            $berita->user_id    =   Auth::guard('operator')->user()->id;
            $berita->slug = \Str::slug($request->judul);
            $berita->save();
        }

        

        return redirect()->route('operator.berita')->with(['success' =>  'berita baru berhasil ditambahkan !']);
    }

    public function edit($id) {
        $berita= Berita::find($id);
        return $berita;
    }

    public function update(Request $request) {
        $berita = Berita::find($request->id);

        $model = $request->all();
        $model['gambar'] = $berita->gambar;
        if ($request->hasFile('gambar')){
            if (!$berita->gambar == NULL){
                unlink(public_path($berita->gambar));
            }
            $model['gambar'] = '/upload/gambar_berita/'.Str::slug($model['judul'], '-').'.'.$request->gambar->getClientOriginalExtension();
        return $slug;
        $request->gambar->move(public_path('/upload/gambar_berita/'), $model['gambar']);
        }

        $berita= Berita::find($request->id);
        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        $berita->gambar = $model['gambar'];
        $berita->slug = \Str::slug($request->judul);
        $berita->update();

        return redirect()->route('operator.berita')->with(['success' =>  'berita baru berhasil ditambahkan !']);
    }

    public function delete(Request $request) {
        $berita = Berita::find($request->id);
        $berita->delete();

        return redirect()->route('operator.berita')->with(['success' => 'berita telah dihapus !']);
    }

    public function detail($id,$slug){
        $berita = Berita::find($id);
        $profils = Profil::first();
        return view('backend/operator/berita.detail',compact('berita','profils'));
    }
}
