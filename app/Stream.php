<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    public function station(){
        return $this->hasOne(Station::class, 'id', 'station_id');
    }

    public function getUrl(){
        return env('APP_URL', '') . '/restream/' . $this->id . '/' . rand(1, 100000000);
    }
}
