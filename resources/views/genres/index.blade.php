@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($genres as $genre)
                <div class="col-md-3">
                    {{ $genre->name }} ({{ count($genre->stations) }})
                </div>
            @endforeach
        </div>
    </div>
@endsection