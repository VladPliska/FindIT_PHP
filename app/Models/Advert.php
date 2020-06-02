<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $table = 'advert';
    protected $fillable = [
        'title','company_id','office','home','city','minSallary','maxSallary','description','technology','skills'
    ];

    protected $casts = [
        'technology' => 'array',
    ];

    public function company(){
        return $this->belongsTo('App\models\Company');
    }
}
