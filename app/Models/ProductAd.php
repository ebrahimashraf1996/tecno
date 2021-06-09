<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProductAd extends Model
{
    //product_ads
    protected $table = "product_ads";


    protected $fillable = ['title_ar', 'title_en', 'content_ar', 'content_en', 'photo', 'product_id', 'is_active', 'created_at', 'updated_at'];


    public function getActive()
    {
        return $this->is_active == 0 ? 'غير مفعل' : 'مفعل';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeSelection($query)
    {
        return $query->select([
            'id',
            'title_' . LaravelLocalization::getCurrentLocale() . ' as title',
            'content_' . LaravelLocalization::getCurrentLocale() . ' as content',
            'photo',
            'product_id',
            'is_active',
        ]);
    }


    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/ads/' . $val) : "";
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
