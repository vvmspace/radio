@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($countries as $country)
                <div class="col-md-3">
                    <a href="/from-{{ $country->slug }}" title="Listen radio from {{ $country->name }} online">{{ $country->name }}</a> ({{ count($country->stations) }})
                </div>
            @endforeach
        </div>
    </div>
@endsection