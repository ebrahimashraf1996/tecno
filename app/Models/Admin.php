<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;


class Admin extends Authenticatable
{

    protected $table = "admins";

    protected $fillable = ['name', 'email', 'password', 'created_at', 'updated_at'];
    protected $guarded = [];
    protected $hidden = ['password'];

    public function setPasswordAttribute($val)
    {
        $this->attributes['password'] = Hash::make($val);
    }

    public function scopeSelection($q) {
        return $q->select(['name', 'email']);
    }

    public $timestamps = true;
}
