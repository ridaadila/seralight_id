<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Digunakan extends Model
{
    // protected $primaryKey = 'id_transaction';
    // protected $primaryKey = 'id_product';

    protected $table = 'digunakan';
    // protected $primaryKey = ['id_transaction','id_product'];

    protected $fillable = [
        'quantity',
    ];

    // public function transaction(){
    //     return $this->hasMany('App\Transaction', 'id_transaction', 'id_product');
    // }

    // public function product() {
    //     return $this->hasMany('App\Product', 'id_product');
    // }
}
