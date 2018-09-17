<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpiderLink extends Model
{
    static function addUnique($url){
        $sl = SpiderLink::where('url', $url)->first();
        if(empty($sl)){
           $sl = new SpiderLink();
           $sl->url = $url;
           $sl->save();
        }
    }
}
