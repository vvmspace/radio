<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eddieace\PhpSimple\HtmlDomParser;

class Genre extends Model
{
    public function stations()
    {
        return $this->belongsToMany(Station::class)
            ->withTimestamps();
    }


    static function parse(){
            $dom = HtmlDomParser::file_get_html('https://www.' . 'live' . 'radio.' . 'ie/genres');
            $countries_dom = $dom->find('.list_categories .list_item a');
            $countdown = count($countries_dom);
            foreach ($countries_dom as $country_dom){
                $countdown--;
                $url = 'https://www.'.'live' . 'radio.ie' . $country_dom->getAttribute('href') . '?order=views';
                echo "{$countdown} {$url}\r\n";
                sleep(5);
                $cp = HtmlDomParser::file_get_html($url);
                $a = 'https://www.live' . 'radio' . '.ie' . $cp->find('.list_stations .list_item a')[0]->getAttribute('href');
                SpiderLink::addUnique($a);
            }
    }
}
