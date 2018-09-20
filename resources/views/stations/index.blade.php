@extends('layouts.app')
@section('title', $title ?? config('app.name', 'Laravel'))
@section('content')
    <div class="container">
        <div class="row">
            @if(!empty($h1))
            <div class="col-md-12">
                <h1>{{ $h1 }}</h1>
            </div>
            @endif
        @foreach($stations as $station)
            <div class="col-md-4">@php $stream = $station->best_stream(); @endphp
                <div><b><a href="/{{ $station->slug }}-online">{{ $station->name  }}</a></b> {{ $station->country->name }}</div>
                <div><audio data-id="{{ $stream->id }}" data-station="{{ $station->id }}" style="width: 100%;" src="{{ $stream->getUrl() }}" controls preload="none"></audio></div>
            </div>
        @endforeach
            <div class="col-md-12">
                {{ $stations->links() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            $('.pagination').addClass('flex-wrap');
        });
    </script>
    <script src="/js/reporter.js?{{ rand(1,100000) }}"></script>
@endsection