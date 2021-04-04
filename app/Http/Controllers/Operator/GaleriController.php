<?php

namespace App\Http\Controllers\Operator;

use App\Galeri;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function index(){
        $galeris = Galeri::select('id','gambar','judul')->get();
        return view('backend/operator/galeri.index',compact('galeris'));
    }

    public function post(Request $request){
        $model = $request->all();
        $model['gambar'] = null;

        if ($request->hasFile('gambar')){
            $model['gambar'] = '/upload/gambar_galeri/'.Str::slug($model['title'], '-').'.'.$request->gambar->getClientOriginalExtension();
            $request->gambar->move(public_path('/upload/gambar_galeri/'), $model['gambar']);
        }
        $galeri = new Galeri();
        $galeri->judul = $request->title;
        // $galeri->slogan = $request->slogan;
        $galeri->gambar = $model['gambar'];
        $galeri->save();

        return redirect()->route('operator.galeri')->with(['success'    =>  'Data galeri baru sudah ditambahkan !']);
    }

    public function delete(Request $request){
        $galeri = Galeri::find($request->id);
        $galeri->delete();

        return redirect()->route('operator.galeri')->with(['success'    =>  'Data galeri baru sudah dihapus !']);
    }
}
