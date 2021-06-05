<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProjectInfo extends Model
{

    protected $table = "project_info";

    protected $fillable = ['title_ar', 'title_en', 'logo', 'created_at', 'updated_at'];


    public function  getLogoAttribute($val){
        return ($val !== null) ? asset('assets/images/projectLogo/' . $val) : "";
    }


    public function scopeSelection($query){
        return $query -> select([
            'title_'.LaravelLocalization::getCurrentLocale().' as title',
            'logo',
        ]) ;
    }

}
