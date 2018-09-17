@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($genres as $genre)
                <div class="col-md-3">
                    <a href="/like-{{ $genre->slug }}" title="Listen {{ $genre->name }} radio online">{{ $genre->name }}</a> ({{ count($genre->stations) }})
                </div>
            @endforeach
        </div>
    </div>
@endsection