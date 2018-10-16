<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    public function station(){
        return $this->hasOne(Station::class, 'id', 'station_id');
    }

    public function getUrl(){
        return env('APP_URL', '') . '/restream/' . $this->id . '/' . rand(1, 100000000);
    }

    public function reportError(){
        $this->errors++;
        $this->save();
        $this->station->errors++;
        $this->station->save();
        return $this->station;
    }

    public function check(){
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $this->stream_url);
        curl_setopt($curlHandle, CURLOPT_HEADER, true);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT_MS, 3000);
        curl_exec($curlHandle);
        $response = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
        curl_close($curlHandle);

        return ($response > 0) && ($response < 400);
    }
}
