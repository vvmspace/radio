<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function stations(){
        return $this->hasMany(Station::class, 'country_id', 'id');
    }
}
