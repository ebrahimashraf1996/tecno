<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Ad extends Model
{
    //product_ads
    protected $table = "ads";


    protected $fillable = ['title_ar', 'title_en', 'content_ar', 'content_en', 'photo', 'parent_status','product_id', 'offer_id', 'is_active', 'created_at', 'updated_at'];


    public function getActive()
    {
        return $this->is_active == 0 ? 'غير مفعل' : 'مفعل';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopeParentActive($query)
    {
        return $query->where('parent_status', 1);
    }

    public function scopeSelection($query)
    {
        return $query->select([
            'id',
            'title_' . LaravelLocalization::getCurrentLocale() . ' as title',
            'content_' . LaravelLocalization::getCurrentLocale() . ' as content',
            'photo',
            'product_id',
            'offer_id',
            'parent_status',
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
    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }

}
