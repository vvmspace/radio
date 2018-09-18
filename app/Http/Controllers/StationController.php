<?php

namespace App\Http\Controllers;

use App\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stations.index', ['stations' => Station::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Station  $stream
     * @return \Illuminate\Http\Response
     */
    public function show(Station $station, $slug)
    {
        $station = Station::where('slug', $slug)->first();
        return view('stations.show', ['station' => $station, 'title' => "Listen {$station->name} online"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Station  $stream
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $station)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Station  $stream
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Station $station)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Station  $stream
     * @return \Illuminate\Http\Response
     */
    public function destroy(Station $station)
    {
        //
    }

    public function show_site($slug){
        $station = Station::where('slug', $slug)->first();
        if($station){
            return view('stations.show', ['station' => $station]);
        }
    }

    public function m3u($slug){
        $station = Station::where('slug', $slug)->first();
        return response(view('stations.m3u', ['station' => $station]), 200)
            ->header('Content-Type', 'audio/mpegurl')->header('Content-Disposition', 'attachment');
    }
}
