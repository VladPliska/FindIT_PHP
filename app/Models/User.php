<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $fillable = [
       'token','name','surname','phone','username','sallary','experience', 'office','home','technology','selectadvert','role','email','block','password','img','resume'
    ];

    protected $casts = [
        'technology' => 'array',
        'selectadvert' => 'array',

    ];





//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];
}
