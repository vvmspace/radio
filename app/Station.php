<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public function streams(){
        return $this->hasMany(Stream::class, 'station_id', 'id');
    }
    static function CreateFromSpider($parsed){
        $station = Station::where('slug', $parsed['slug'])->first();
        if(empty($station)){

            $station = new Station();
            $station->slug = $parsed['slug'];
            $station->name = $parsed['name'];
            $station->save();

            $stream = new Stream();
            $stream->station_id = $station->id;
            $stream->stream_url = $parsed['stream_url'];
            $stream->kbps = 256;
            $stream->save();

            foreach ($parsed['genres'] as $genre_data){
                $genre = Genre::where('name', $genre_data['name'])->first();
                if(empty($genre)){
                    $genre = new Genre();
                    $genre->name = $genre_data['name'];
                    $genre->slug = $genre_data['slug'];
                    $genre->save();
                }
                $station->genres()->save($genre);
            }

            $country = Country::where('name', $parsed['country']['name'])->first();
            if(empty($country)){
                $country = new Country();
                $country->name = $parsed['country']['name'];
                $country->slug = $parsed['country']['slug'];
                $country->save();
            }
            $station->country_id = $country->id;
            $station->save();
        }
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'station_genre')
            ->withTimestamps();
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function best_stream(){
        return Stream::where('station_id', $this->id)->orderBy('kbps', 'desc')->first();
    }
}
