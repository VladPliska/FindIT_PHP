<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $fillable = [
       'token','email','password','name','city','img','office','home','workers','technology','description'
    ];

    protected $casts = [
        'technology' => 'array',
    ];


//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];
    public function advert(){
        return $this->hasMany('App\models\Advert');
    }

}
