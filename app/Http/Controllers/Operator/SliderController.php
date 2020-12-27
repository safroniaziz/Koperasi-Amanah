<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function index(){
        $sliders = Slider::select('id','gambar','title','slogan')->get();
        return view('backend/operator/slider.index',compact('sliders'));
    }

    public function post(Request $request){
        $model = $request->all();
        $model['gambar'] = null;

        if ($request->hasFile('gambar')){
            $model['gambar'] = '/upload/gambar_slider/'.Str::slug($model['title'], '-').'.'.$request->gambar->getClientOriginalExtension();
            $request->gambar->move(public_path('/upload/gambar_slider/'), $model['gambar']);
        }
        $slider = new Slider;
        $slider->title = $request->title;
        $slider->slogan = $request->slogan;
        $slider->gambar = $model['gambar'];
        $slider->save();

        return redirect()->route('operator.slider')->with(['success'    =>  'Data slider baru sudah ditambahkan !']);
    }

    public function update(Request $request){
        $slider = Slider::find($request->id);

        $model = $request->all();
        $model['gambar'] = $slider->gambar;
        if ($request->hasFile('gambar')){
            if (!$slider->gambar == NULL){
                unlink(public_path($slider->gambar));
            }
            $model['gambar'] = '/upload/gambar_slider/'.Str::slug($model['title'], '-').'.'.$request->gambar->getClientOriginalExtension();
            $request->gambar->move(public_path('/upload/gambar_slider/'), $model['gambar']);
        }
        $slider->title = $request->title;
        $slider->slogan = $request->slogan;
        $slider->gambar = $model['gambar'];
        $slider->update();

        return redirect()->route('operator.slider')->with(['success'    =>  'Data slider baru sudah diubah !']);
    }

    public function edit($id){
        $slider = Slider::find($id);
        return $slider;
    }

    public function delete(Request $request){
        $slider = Slider::find($request->id);
        $slider->delete();

        return redirect()->route('operator.slider')->with(['success'    =>  'Data slider baru sudah dihapus !']);
    }
}
