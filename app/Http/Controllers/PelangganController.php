<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class PelangganController extends Controller
{
    public function index(){
        if(Auth::user()->level=="admin"){
          $p=Pelanggan::get();
          return response()->json($p);
        } else {
          return response()->json(['status'=>'anda bukan admin']);
        }
      }
      public function store(Request $req){
        $validator = Validator::make($req->all(),
        [
          'nama' => 'required',
          'alamat' => 'required',
          'telp' => 'required'
        ]);
        if($validator->fails()){
          return Response()->json($validator->errors());
        }
        $simpan = Pelanggan::create([
          'nama' => $req->nama,
          'alamat' => $req->alamat,
          'telp' => $req->telp
        ]);
        $status=1;
        $message="Yey Kamu Berhasil Pelanggan  ditambahkan";
        if($simpan){
          return Response()->json(compact('status','message'));
        } else {
          return Response()->json(['status' => 0]);
        }
      }
      public function update($id, Request $req){
        $validator = Validator::make($req->all(),
        [
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required'
        ]);
        if($validator->fails()){
          return Response()->json($validator->errors());
        }
        $ubah = pelanggan::where('id', $id)->update([
            'nama' => $req->nama,
            'alamat' => $req->alamat,
            'telp' => $req->telp
        ]);
        $status=1;
        $message="Yey Kamu Berhasil Mengubah";
        if($ubah){
          return Response()->json(compact('status','message'));
        } else {
          return Response()->json(['status' => 0]);
        }
      }
      public function tampil(){
        $p=Pelanggan::get();
        $count=$p->count();
        $arr_data=array();
        foreach ($p as $p){
          $arr_data[]=array(
            'id' => $p->id,
            'nama' => $p->nama,
            'alamat' => $p->alamat,
            'telp' => $p->telp
          );
        }
        $status=1;
        return Response()->json(compact('status','count','arr_data'));
      }
      public function destroy($id){
        $hapus = Pelanggan::where('id', $id)->delete();
        $status=1;
        $message="Yey Kamu Berhasil Menghapus";
        if($hapus){
          return Response()->json(compact('status','message'));
        } else {
          return Response()->json(['status' => 0]);
        }
      }
}

