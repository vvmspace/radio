<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public function streams(){
        return $this->hasMany(Stream::class, 'station_id', 'id');
    }
}
