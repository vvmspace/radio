@extends('layouts.app')
@section('title', $title ?? config('app.name', 'Laravel'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $station->name }}</h1>
                <p>Genres: @foreach($station->genres as $genre)
                    <a href="/like-{{ $genre->slug }}">{{ $genre->name }}</a>
                @endforeach</p>
                <p>Country: <a href="/from-{{ $station->country->slug }}" title="Listen radio from {{ $station->country->name }} online">{{ $station->country->name }}</a></p>
                <p>Listened {{ $station->listened ?? 0 }} times</p>
            </div>
            <div class="col-md-12"><audio src="{{ $station->best_stream()->getUrl() }}" controls preload="none"></audio></div>
            <div class="col-md-12">
                <h2>Listen {{ $station->name }} in Winamp/Aimp online:</h2>
                <p>Just <b>download <a href="/m3u/{{ $station->slug }}_Radio.VVM.SPACE.m3u">m3u</a> file</b> and open it in your favorite player!</p>
            </div>
            <div class="col-md-12">
                <h2>Share {{ $station->name }} live stream link with friends:</h2>
                <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                <script src="//yastatic.net/share2/share.js"></script>
                <div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,gplus,twitter" data-counter=""></div>
            </div>
        </div>
    </div>
@endsection