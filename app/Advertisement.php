<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table = 'advertisement';
    protected $fillable = ['name', 'video_mp4', 'video_ogg', 'video_webm', 'redirect_url', 'max_played', 'played', 'skip_duration', 'skipped', 'sorting', 'active'];

    public function log()
    {
        return $this->hasMany('App\AdsLog', 'advertisement_id', 'id');
    }
}
