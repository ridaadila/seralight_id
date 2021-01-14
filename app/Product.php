<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id_product';
    protected $table = 'product';

    protected $fillable = [
        'photo','name_product','description','stock','weight','price','id_category'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id_user', 'id_user');
    }

    public function category(){
        return $this->belongsTo('App\Category', 'id_category', 'id_product');
    }

    public function transaction(){
        return $this->belongsToMany('App\Transaction', 'digunakan', 'id_product', 'id_transaction', 'id_product')->withPivot('quantity');
    }

    // public function digunakan() {
    //     return $this->hasMany('App\Digunakan', 'id_product', 'id_transaction', 'id_product');
    // }
}
