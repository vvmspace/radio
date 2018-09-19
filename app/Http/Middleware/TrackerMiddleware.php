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
            $referer = $_SERVER['HTTP_REFERER'] ?? null;
            $visit = new TrackVisit();
            $visit->track_id = Track::GetOrCreate();
            $visit->user_id = Auth::check() ? Auth::user()->id : null;
            $visit->previous_id = Previous::GetId($referer);
            $visit->uri = $request->path();
            $visit->save();
        // }
        return $next($request);
    }
}
