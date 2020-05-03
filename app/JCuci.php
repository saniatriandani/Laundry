<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JCuci extends Model
{
    protected $table="jenis_cuci";
    protected $primaryKey="id";
    protected $fillable = [
      'nama_jenis', 'harga_perkilo'
    ];

    public function JCuci(){
      return $this->hasMany('App\JCuci','id');
    }
    public $timestamps = false;
}
