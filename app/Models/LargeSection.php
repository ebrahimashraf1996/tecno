<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LargeSection extends Model
{
    protected $table = "large_sections";


    protected $fillable = ['title_ar', 'title_en', 'large_p_ar', 'large_p_en', 'photo', 'is_active', 'created_at', 'updated_at'];


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
            'large_p_'. LaravelLocalization::getCurrentLocale().' as large_p',
            'photo',
            'is_active']) ;
    }
    public function scopeWithRelation($query) {
        return $query-> with(['smallSections' => function ($q) {
            $q->get();
        }]);
    }

    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/largeSections/' . $val) : "";
    }

}
