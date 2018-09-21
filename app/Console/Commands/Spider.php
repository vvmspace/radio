<?php

namespace App\Console\Commands;

use App\SpiderLink;
use App\Station;
use Illuminate\Console\Command;
use Eddieace\PhpSimple\HtmlDomParser;

class Spider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sl = SpiderLink::whereNull('parsed')->inRandomOrder()->first();
        $parsed = Spider::ParseLiveRadio($sl->url);
        if(!empty($parsed['links'])){
            foreach ($parsed['links'] as $link){
                SpiderLink::addUnique($link);
            }
        }
        $sl->parsed = true;
        $sl->save();

        if(!empty($parsed['stream_url'])){
            Station::CreateFromSpider($parsed);
        }
    }

    static function ParseLiveRadio($url){
        $dom = HtmlDomParser::file_get_html($url);
        $scripts = $dom->find('script');
        $data = [];
        $data['genres'] = [];
        $data['slug'] = explode('stations/', $url)[1];
        foreach ($scripts as $script){
            $text = $script->innertext();
            $splited = explode('mp3: \'', $text);
            if(count($splited) > 1){
                $data['stream_url'] = explode('\',', $splited[1])[0];
            }
        }
        $genres_dom = $dom->find('span[itemprop="genre"]');
        foreach ($genres_dom as $genre_dom){
            $name = $genre_dom->find('a')[0]->innertext();
            $slug = explode('/stations/genre-', $genre_dom->find('a')[0]->getAttribute('href'))[1];
            $data['genres'][] = [
                'name' => $name,
                'slug' => $slug
            ];
        }

        $country_dom = $dom->find('span[itemprop="addressCountry"]')[0];
        $data['country'] = [
            'name' => $country_dom->find('a')[0]->innertext(),
            'slug' => explode('/stations/country-', $country_dom
                ->find('a')[0]
                ->getAttribute('href'))[1]
        ];


        $sel = '.list_stations_side .list_item .name a';
        $links_dom = $dom->find($sel);
        foreach ($links_dom as $link_dom){
            $data['links'][] = 'https://www.live' . 'radio' . '.ie' . $link_dom->getAttribute('href');
        }
        $data['name'] = $dom->find('h1')[0]->text();
        return $data;
    }
}
