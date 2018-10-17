<?php

namespace App\Http\Middleware;

use Closure;
use App\TrackVisit;
use App\Track;
use App\Previous;
use Illuminate\Support\Facades\Auth;

class TrackerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if(Previous::Stranger()){
            $uri = $request->path();
            if(strpos($uri, 'stream/') < 1){
                $referer = $_SERVER['HTTP_REFERER'] ?? null;
                $visit = new TrackVisit();
                $visit->track_id = Track::GetOrCreate();
                $visit->user_id = Auth::check() ? Auth::user()->id : null;
                $visit->previous_id = Previous::GetId($referer);
                $visit->uri = $uri;
                $visit->save();
            }
        // }
        return $next($request);
    }
}
