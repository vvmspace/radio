@extends('layouts.app')
@section('title', $title ?? config('app.name', 'Laravel'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $station->name }}</h1>
            </div>
            <div class="col-md-12">
                @foreach($station->genres as $genre)
                    <a href="/like-{{ $genre->slug }}">{{ $genre->name }}</a>
                @endforeach
            </div>
            <div class="col-md-12"><audio src="{{ $station->best_stream()->stream_url }}" controls preload="none"></audio></div>
        </div>
    </div>
@endsection