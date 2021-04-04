<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;
use App\Berita;
use App\Galeri;
use App\Profil;
use App\Slider;

class FrontendController extends Controller
{
    public function index(){
        $sliders = Slider::all();
        $profils = Profil::first();
        $jumlah_anggota = count(Anggota::where('status_anggota','1')->get());
        $beritas = Berita::paginate(6);
        $anggotas = Anggota::where('gambar','!=','a')->where('gambar','!=',null)->paginate(8);
        $galeris = Galeri::paginate(6);
        return view('layouts.frontend',compact('sliders','profils','jumlah_anggota','beritas','anggotas','galeris'));
    }

    public function berita(){
        $profils = Profil::first();
        $terbaru = Berita::orderBy('created_at','desc')->get();
        $beritas = Berita::paginate(2);
        $galeris = Galeri::paginate(6);
        return view('frontend/berita.index',compact('beritas','terbaru','profils','galeris'));
    }

    public function beritaDetail($id){
        $profils = Profil::first();
        $terbaru = Berita::orderBy('created_at','desc')->get();
        $berita = Berita::find($id);
        $beritas = Berita::paginate(6);
        $galeris = Galeri::paginate(6);
        return view('frontend/berita.detail',compact('berita','profils','terbaru','beritas','galeris'));
    }
}
