<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//petugas
Route::post('register', 'PetugasController@register');
Route::post('login', 'PetugasController@login');
Route::get('/', function(){
  return Auth::user()->level;
})->middleware('jwt.verify');
Route::get('petugas', 'PetugasController@getAuthenticatedUser')->middleware('jwt.verify');

//pelanggan
Route::get('pelanggan','PelangganController@index')->middleware('jwt.verify');
Route::post('/add_pelanggan','PelangganController@store')->middleware('jwt.verify');
Route::put('/up_pelanggan/{id}','PelangganController@update')->middleware('jwt.verify');
Route::get('/tampil_pelanggan','PelangganController@tampil')->middleware('jwt.verify');
Route::delete('/del_pelanggan/{id}','PelangganController@destroy')->middleware('jwt.verify');

//jenis cuci
Route::get('JCuci','JCuciController@index')->middleware('jwt.verify');
Route::post('/add_JCuci','JCuciController@store')->middleware('jwt.verify');
Route::put('/up_JCuci/{id}','JCuciController@update')->middleware('jwt.verify');
Route::get('/tampil_JCuci','JCuciController@tampil')->middleware('jwt.verify');
Route::delete('/del_JCuci/{id}','JCuciController@destroy')->middleware('jwt.verify');

//transaksi
Route::get('/index/{tgl_transaksi}/{tgl_selesai}', 'TransaksiController@index')->middleware('jwt.verify');
Route::post('/add_transaksi','TransaksiController@store')->middleware('jwt.verify');
Route::put('/up_transaksi/{id}','TransaksiController@update')->middleware('jwt.verify');
Route::delete('/del_transaksi/{id}','TransaksiController@destroy')->middleware('jwt.verify');

//detail
Route::post('/add_detail','DetailController@store')->middleware('jwt.verify');
Route::put('/up_detail/{id}','DetailController@update')->middleware('jwt.verify');
Route::delete('/del_detail/{id}','DetailController@destroy')->middleware('jwt.verify');