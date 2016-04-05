<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsLog extends Model
{
    protected $table = 'log';
    protected $fillable = ['advertisement_id','ip_address','user_agent','date_time','played'];

    public function advertisement()
    {
        return $this->hasOne('App\Advertisement','id','advertisement_id');
    }
}
