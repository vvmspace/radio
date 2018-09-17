@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
        @foreach($stations as $station)
            <div class="col-md-4">
                <div><b><a href="/{{ $station->slug }}-online">{{ $station->name  }}</a></b> {{ $station->country->name }}</div>
                <div><audio src="{{ $station->best_stream()->stream_url }}" controls preload="none"></audio></div>
            </div>
        @endforeach
        </div>
    {{ $stations->links() }}
    </div>
@endsection