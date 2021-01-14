<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $primaryKey = 'id_prov';
    protected $table = 'provinsi';

    protected $fillable = [
        'nama_prov'
    ];

    public function kota(){
        return $this->hasMany('App\Kota', 'id_prov');
    }
}
