<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Catalog extends Model
{
    protected $table = "catalogs";

    protected $fillable = ['title_ar', 'title_en',  'photo', 'pdf', 'is_active', 'created_at', 'updated_at'];


    public function getActive(){
        return  $this -> is_active  == 0 ?  'غير مفعل'   : 'مفعل' ;
    }

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function scopeSelection($query){
        return $query -> select([
            'title_'. LaravelLocalization::getCurrentLocale().' as title',
            'photo',
            'pdf',
            'is_active'
        ]) ;
    }

    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/catalogsCover/' . $val) : "";
    }

    public function  getPdfAttribute($val){
        return ($val !== null) ? asset('assets/PDF/catalogsPDF/' . $val) : "";
    }

}
