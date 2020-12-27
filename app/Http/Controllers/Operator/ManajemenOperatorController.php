<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Jabatan;
use App\Operator;
use Illuminate\Http\Request;

class ManajemenOperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    
    public function index(){
        $operators = Operator::join('jabatans','jabatans.id','operators.jabatan_id')
                                ->select('operators.id','nm_jabatan','nm_operator','status_operator','email')
                                ->get();
        $jabatans = Jabatan::where('status_jabatan','1')->get();
        return view('backend/operator/operator.index',compact('operators','jabatans'));
    }

    public function post(Request $request){
        $this->validate($request, [
            'jabatan_id'  =>  'required',
            'nm_operator'  =>  'required',
            'email'  =>  'required|email',
            'password'  =>  'required',
        ]);

        Operator::create([
            'nm_operator'  =>  $request->nm_operator,
            'jabatan_id'    =>  $request->jabatan_id,
            'email'    =>  $request->email,
            'password'    =>  bcrypt($request->password),
        ]);

        return redirect()->route('operator.manajemen_operator')->with(['success'   =>  'Data Operator Baru Berhasil Ditambahkan !!']);
    }

    public function aktifkanStatus($id){
        Operator::where('id',$id)->update([
            'status_operator'    =>  '1'
        ]);
        return redirect()->route('operator.manajemen_operator')->with(['success' =>  'Status Operator Berhasil Di Aktifkan !!']);
    }

    public function nonaktifkanStatus($id){
        Operator::where('id',$id)->update([
            'status_operator'    =>  '0'
        ]);
        return redirect()->route('operator.manajemen_operator')->with(['success' =>  'Status Operator Berhasil Di Nonaktifkan !!']);
    }

    public function edit($id){
        $data = Operator::find($id);
        return $data;
    }

    public function update(Request $request){
        $this->validate($request, [
            'jabatan_id'  =>  'required',
            'nm_operator'  =>  'required',
            'email'  =>  'required|email',
        ]);

        Operator::where('id',$request->id)->update([
            'nm_operator'  =>  $request->nm_operator,
            'jabatan_id'    =>  $request->jabatan_id,
            'email'    =>  $request->email,
        ]);

        return redirect()->route('operator.manajemen_operator')->with(['success'   =>  'Data Operator Berhasil Diubah !!']);
    }

    public function delete(Request $request){
        Operator::where('id',$request->id)->delete();
        return redirect()->route('operator.manajemen_operator')->with(['success'   =>  'Data Operator Berhasil Dihapus !!']);
    }

    public function updatePassword(Request $request){
        Operator::where('id',$request->id)->update([
            'password'  =>  bcrypt($request->password_baru),
        ]);

        return redirect()->route('operator.manajemen_operator')->with(['success'   =>  'Password Operator Berhasil Diubah !!']);
    }
}
