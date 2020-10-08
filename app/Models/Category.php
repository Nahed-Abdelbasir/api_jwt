<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    protected $fillable = [
        'name_ar', 'name_en', 'active', 'created_at' ,'updated_at',
    ];


    public function scopeNameLang($q){
        return $q->select('name_'. app()->getLocale() . ' as name');
    }

}