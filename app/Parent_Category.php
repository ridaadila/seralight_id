<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parent_Category extends Model
{
    
    protected $primaryKey = 'id_parent';
    protected $table = 'parent_category';

    protected $fillable = [
        'parent_name'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function category(){
        return $this->hasMany('App\Category', 'id_parent', 'id_parent');
    }
}
