<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';
    protected $fillable = [
        'name','advert'
    ];

    public function cityCompany(){
        return $this->hasMany('App\Models\Company');
    }
    public function advert(){
        return $this->hasMany('App\Models\Advert');
    }


//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];
}
