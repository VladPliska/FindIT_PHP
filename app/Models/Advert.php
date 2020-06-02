<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $table = 'advert';
    protected $fillable = [
        'title','company_id','office','home','city_id','minsallary','maxsallary','description','technology','skills'
    ];

    protected $casts = [
        'technology' => 'array',
    ];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function city(){
        return $this->belongsTo('App\Models\City');
    }

}
