<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SmallSection extends Model
{
    protected $table = "small_sections";


    protected $fillable = ['title_ar', 'title_en', 'small_p_ar', 'small_p_en', 'icon', 'large_section_id', 'is_active', 'created_at', 'updated_at'];


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
            'title_' . LaravelLocalization::getCurrentLocale() . ' as title',
            'small_p_' . LaravelLocalization::getCurrentLocale() . ' as small_p',
            'icon',
            'large_section_id',
            'is_active',
        ]);
    }

    public function largeSection()
    {
        return $this->belongsTo(LargeSection::class, 'large_section_id');
    }

}
