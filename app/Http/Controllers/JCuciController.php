<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\JCuci;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;


class JCuciController extends Controller
{
    public function index(){
        if(Auth::user()->level=="admin"){
          $jc=JCuci::get();
          return response()->json($jc);
        } else {
          return response()->json(['status'=>'anda bukan admin']);
        }
      }
      public function store(Request $req){
        $validator = Validator::make($req->all(),
        [
          'nama_jenis' => 'required',
          'harga_perkilo' => 'required'
        ]);
        if($validator->fails()){
          return Response()->json($validator->errors());
        }
        $simpan = JCuci::create([
          'nama_jenis' => $req->nama_jenis,
          'harga_perkilo' => $req->harga_perkilo
        ]);
        $status=1;
        $message="Yey Kamu Berhasil Menambahkan Jenis Cuci";
        if($simpan){
          return Response()->json(compact('status','message'));
        } else {
          return Response()->json(['status' => 0]);
        }        
      }
      public function update($id, Request $req){
        $validator = Validator::make($req->all(),
        [
            'nama_jenis' => 'required',
            'harga_perkilo' => 'required'
        ]);
        if($validator->fails()){
          return Response()->json($validator->errors());
        }
        $ubah = JCuci::where('id', $id)->update([
            'nama_jenis' => $req->nama_jenis,
            'harga_perkilo' => $req->harga_perkilo
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
        $jc=JCuci::get();
        $count=$jc->count();
        $arr_data=array();
        foreach ($jc as $jc){
          $arr_data[]=array(
            'id' => $jc->id,
            'nama_jenis' => $jc->nama_jenis,
            'harga_perkilo' => $jc->harga_perkilo
          );
        }
        $status=1;
        return Response()->json(compact('status','count','arr_data'));
      }
      public function destroy($id){
        $hapus = JCuci::where('id', $id)->delete();
        $status=1;
        $message="Yey Kamu Berhasil Menghapus";
        if($hapus){
          return Response()->json(compact('status','message'));
        } else {
          return Response()->json(['status' => 0]);
        }
      }
}
