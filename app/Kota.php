<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $primaryKey = 'id_kota';
    protected $table = 'kota';

    protected $fillable = [
        'nama_kota'
    ];

    public function transaction() {
        return $this->hasMany('App\Transaction', 'id_kota');
    }

    public function provinsi(){
        return $this->belongsTo('App\Provinsi', 'id_prov');
    }
}
