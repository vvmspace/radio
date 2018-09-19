<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    static function GetOrCreate(){

        if(!isset($_COOKIE['track'])){
            $track = new static();
            $track->save();
            $track_id = $track->id;
            setcookie('track', $track_id,time() + 5 * 365 * 24 * 60 * 60, '/');
            return $track_id;
        }

        return $_COOKIE['track'];

    }
}
