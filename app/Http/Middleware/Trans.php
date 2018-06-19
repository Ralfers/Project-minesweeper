<?php

namespace App\Http\Middleware;

use Closure;

class Trans
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
        $user = \Auth::user();

        if(!$user){
            \App::setLocale(\Session::get('locale'));
        }
        else{
            \App::setLocale($user->locale);
        }

        return $next($request);
    }
}
