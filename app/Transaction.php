<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = 'id_transaction';
    protected $table = 'transaction';

    protected $fillable = [
        'lama_kirim','quantity_total','biaya_ongkir','total_harga','subtotal','address_receiver','portal_code','ekspedition','kota','provinsi'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }

    public function product(){
        return $this->belongsToMany('App\Product', 'digunakan', 'id_transaction', 'id_product', 'id_transaction')->withPivot('quantity');
    }

    public function kota(){
        return $this->belongsTo('App\Kota', 'id_kota');
    }

    // public function digunakan() {
    //     return $this->hasMany('App\Digunakan', 'id_transaction', 'id_product', 'id_transaction');
    // }
}
