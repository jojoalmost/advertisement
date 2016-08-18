<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'general_setting';
    protected $fillable = ['option', 'value','key'];

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
}
