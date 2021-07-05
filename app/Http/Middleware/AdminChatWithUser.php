<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminChatWithUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
         if (auth()->user()->utype === "ADM" || auth()->user()->utype === "USR") 
         {
            return $next($request);
        } else {
            abort(404);
        }
        return $next($request);
    }
}
