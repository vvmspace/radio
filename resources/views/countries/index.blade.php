@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($countries as $country)
                <div class="col-md-3">
                    {{ $country->name }} ({{ count($country->stations) }})
                </div>
            @endforeach
        </div>
    </div>
@endsection