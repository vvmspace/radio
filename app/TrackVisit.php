<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrackVisit extends Model
{
    function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    function previous(){
        return $this->hasOne(Previous::class, 'id', 'previous_id');
    }
}
