<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = "product_images";


    protected $fillable = ['photo', 'is_active', 'product_id', 'created_at', 'updated_at'];


    public function getActive(){
        return  $this -> is_active  == 0 ?  'غير مفعل'   : 'مفعل' ;
    }

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function scopeSelection($query){
        return $query -> select(['id', 'photo', 'is_active', 'product_id']) ;
    }

    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/productImages/' . $val) : "";
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
