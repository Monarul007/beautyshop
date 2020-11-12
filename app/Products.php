<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function attributes(){
        return $this->hasMany('App\ProductAttributes','product_id');
    }
    public function images(){
        return $this->hasMany('App\ProductImages','product_id');
    }
}
