<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Product extends Model
{
    protected $table = "products";


    protected $fillable = ['title_ar', 'title_en', 'content_ar', 'content_en', 'photo', 'is_active', 'created_at', 'updated_at'];


    public function getActive(){
        return  $this -> is_active  == 0 ?  'غير مفعل'   : 'مفعل' ;
    }

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function scopeSelection($query){
        return $query -> select([
            'id',
            'title_'. LaravelLocalization::getCurrentLocale().' as title',
            'content_'. LaravelLocalization::getCurrentLocale().' as content',
            'photo',
            'is_active'
        ]) ;
    }

    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/products/' . $val) : "";
    }

    public function ads() {
        return $this->hasMany(ProductAd::class, 'product_id');
    }

    public function images() {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

}
