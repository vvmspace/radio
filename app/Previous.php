<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Previous extends Model
{
    static function GetId($url){
        $previous = Previous::where('url', $url)->first();
        if(empty($previous)){
            $previous = new Previous();
            $previous->url = $url;
            $previous->save();
        }
        return $previous->id;
    }

    static function Stranger(){
        $url = $_SERVER['HTTP_REFERER'] ?? null;
        $local_domain = parse_url(env('APP_URL'))['host'];
        $previous_domain = parse_url($url)['host'] ?? null;
        return $local_domain != $previous_domain;
    }
}
