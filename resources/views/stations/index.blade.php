@extends('layouts.app')
@section('content')
    @foreach($stations as $station)
    @endforeach
    {{ $stations->links }}
@endsection