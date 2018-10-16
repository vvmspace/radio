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
        curl_setopt($curlHandle, CURLOPT_NOBODY  , true);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT_MS, 1000);
        curl_exec($curlHandle);
        $curl_errno = curl_errno($curlHandle);
        $response = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
        curl_close($curlHandle);

        return ($response < 400) && (empty($curl_errno));
    }
}
