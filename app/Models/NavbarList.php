<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class NavbarList extends Model
{


    protected $table = "navbar_lists";


    protected $fillable = ['name_ar', 'name_en', 'is_active', 'created_at', 'updated_at'];


    public function getActive(){
        return  $this -> is_active  == 0 ?  'غير مفعل'   : 'مفعل' ;
    }

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function scopeSelection($query){
        return $query -> select([
            'id',
            'name_'. LaravelLocalization::getCurrentLocale().' as name',
            'slug',
            'is_active'
        ]) ;
    }

}
