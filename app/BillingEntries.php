<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingEntries extends Model
{
    protected $table = 'billing';
    protected $guarded = [];

    public function customers(){
        return $this->hasOne('App\User','id','user_id');
    }
}
