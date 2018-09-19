@extends('layouts.app')
@section('title', $title ?? config('app.name', 'Laravel'))
@section('content')
    <div class="container">
        <div class="row">
        @foreach($stations as $station)
            <div class="col-md-4">
                <div><b><a href="/{{ $station->slug }}-online">{{ $station->name  }}</a></b> {{ $station->country->name }}</div>
                <div><audio style="width: 100%;" src="{{ $station->best_stream()->getUrl() }}" controls preload="none"></audio></div>
            </div>
        @endforeach
            <div class="col-md-12">
                {{ $stations->links() }}
            </div>
        </div>
    </div>
@endsection