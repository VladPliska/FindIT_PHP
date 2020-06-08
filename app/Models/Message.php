<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'message';

    protected $fillable = [
            'user_id',
            'company_id',
            'message',
        'token',        /// answer id
        'status',
        'advert_id',
        'sender'
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
