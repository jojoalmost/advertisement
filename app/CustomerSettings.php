<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerSettings extends Model
{
    protected $table = 'customer_setting';
    protected $guarded = [];

    public function customer(){
        return $this->hasOne('App\User','id','user_id');
    }
}
