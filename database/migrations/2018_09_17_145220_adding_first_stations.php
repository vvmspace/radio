<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Station;
use App\Stream;

class AddingFirstStations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $stations = [[
            'name' => 'Radio Record',
            'slug' => 'radiorecord',
            'streams' => [
                320 => 'http://air.radiorecord.ru:805/rr_320',
                128 => 'http://air.radiorecord.ru:805/rr_128',
                64 => 'http://air.radiorecord.ru:805/rr_64'
            ]],
            [
            'name' => 'Maxima FM',
            'slug' => 'maximafm',
            'streams' => [
                128 => 'http://19373.live.streamtheworld.com/MAXIMAFMAAC.aac'
            ]],
            [
            'name' => 'Storm North East',
            'slug' => 'storm-north-east',
            'streams' => [
                256 => 'http://80.249.249.243:8050/;stream/1'
            ]],
        ];
        foreach ($stations as $station_data){
            $station = new App\Station();
            $station->name = $station_data['name'];
            $station->slug = $station_data['slug'];
            $station->save();
            foreach ($station_data['streams'] as $kbps => $url){
                $stream = new App\Stream();
                $stream->station_id = $station->id;
                $stream->kbps = $kbps;
                $stream->stream_url = $url;
                $stream->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
