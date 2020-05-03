<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table="pelanggan";
    protected $primaryKey="id";
    protected $fillable = [
      'nama', 'alamat', 'telp'
    ];

    public function petugas(){
        return $this->belongsTo('App/Petugas','id_petugas');
      }
      public $timestamps = false;
}
