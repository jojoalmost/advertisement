<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsLog extends Model
{
    protected $table = 'log';
    protected $fillable = ['advertisement_id','ip_address','user_agent','date_time'];

    public function advertisement()
    {
        return $this->hasOne('App\Advertisement','advertisement_id','id');
    }
}
