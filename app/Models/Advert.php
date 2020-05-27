<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $table = 'adverts';
    protected $fillable = [
        'title','company','office','home','city','minSallary','maxSallary','description','technology','skills'
    ];

    protected $casts = [
        'technology' => 'array',
    ];

}
