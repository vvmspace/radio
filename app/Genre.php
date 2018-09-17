<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function stations()
    {
        return $this->belongsToMany(Station::class)
            ->withTimestamps();
    }
}
