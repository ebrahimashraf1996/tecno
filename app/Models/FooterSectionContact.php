<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FooterSectionContact extends Model
{
    protected $table = "footer_section_contacts";


    protected $fillable = ['title_ar', 'title_en', 'span_ar', 'span_en', 'is_active', 'created_at', 'updated_at'];


    public function getActive(){
        return  $this -> is_active  == 0 ?  'غير مفعل'   : 'مفعل' ;
    }

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function scopeSelection($query){
        return $query -> select([
            'title_'. LaravelLocalization::getCurrentLocale().' as title',
            'span_'. LaravelLocalization::getCurrentLocale().' as span',
            'is_active'
        ]) ;
    }

}
