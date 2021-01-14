<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id_category';
    protected $table = 'category';

    protected $fillable = [
        'category_name','id_parent','id_user'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id_user', 'id_category');
    }

    public function parent(){
        return $this->belongsTo('App\Parent_Category', 'id_parent', 'id_category');
    }

    public function product(){
        return $this->hasMany('App\Product', 'id_category', 'id_category');
    }
}
