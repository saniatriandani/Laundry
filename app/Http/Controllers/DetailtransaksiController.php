<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\JCuci;
use App\Detail;
use Tymon\JWTAuth\Exceptions\JWTException;

class DetailController extends Controller
{
    public function store(Request $req){
        $validator = Validator::make($req->all(),
        [
          'id_transaksi' => 'required',
          'id_jenis' => 'required',
          'qty' => 'required'
        ]);
        if($validator->fails()){
          return Response()->json($validator->errors());
        }
        $harga= JCuci::where ('id', $req->id_jenis)->first();
        $subtotal= $harga->harga_perkilo * $req->qty;

        $simpan = Detail::create([
          'id_transaksi' => $req->id_transaksi,
          'id_jenis' => $req->id_jenis,
          'qty' => $req->qty,
          'subtotal'=>$subtotal
        ]);
        $status=1;
        $message="Yey Kamu Berhasil detail  ditambahkan";
        if($simpan){
          return Response()->json(compact('status','message'));
        } else {
          return Response()->json(['status' => 0]);
        }
      }
      public function update($id, Request $req){
        $validator = Validator::make($req->all(),
        [
            'id_transaksi' => 'required',
            'id_jenis' => 'required',
            'qty' => 'required',
            'subtotal' => 'required'
        ]);
        if($validator->fails()){
          return Response()->json($validator->errors());
        }
        $ubah = Detail::where('id', $id)->update([
            'id_transaksi' => $req->id_transaksi,
          'id_jenis' => $req->id_jenis,
          'qty' => $req->qty,
          'subtotal'=>$subtotal
        ]);
        $status=1;
        $message="Yey Kamu Berhasil Mengubah";
        if($ubah){
          return Response()->json(compact('status','message'));
        } else {
          return Response()->json(['status' => 0]);
        }
      }
      public function destroy($id){
        $hapus = Detail::where('id', $id)->delete();
        $status=1;
        $message="Yey Kamu Berhasil Menghapus";
        if($hapus){
          return Response()->json(compact('status','message'));
        } else {
          return Response()->json(['status' => 0]);
        }
      }
}
