<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answer';

    protected $fillable = [
        'user_id',
        'company_id',
        'fullname',
        'email',
        'phone',
        'sallary',
        'resume',
        'advert_id',
        'status'
    ];


    public function advert(){
        return $this->belongsTo('App\Models\Advert');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
