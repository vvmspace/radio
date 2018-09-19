#EXTM3U

@foreach($station->streams as $stream)
#EXTINF: {{ $station->name }} {{ $stream->kbps }}kbps - {{ env('APP_NAME') }} {{ env('APP_URL') }}
{{ $stream->getUrl() }}
@endforeach