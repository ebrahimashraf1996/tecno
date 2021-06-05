<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUsUser extends Model
{

    protected $table = "contact_us_users";


    protected $fillable = ['name', 'email', 'address', 'message', 'is_checked', 'created_at', 'updated_at'];


    public function scopeNotChecked($query){
        return $query -> where('is_checked',0) ;
    }


    public function getChecked(){
        return  $this -> is_checked  == 0 ?  'غير مقروءة'   : 'مقروءة' ;
    }


    public function scopeSelection($query){
        return $query -> select([
            'id',
            'name',
            'email',
            'address',
            'message',
            'is_checked',
            'created_at'
        ]) ;
    }


}
