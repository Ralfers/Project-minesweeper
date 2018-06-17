<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class AuditLog
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

        //dd($request);

        $user = Auth::user();
        $userId = 0;
        if($user){
            $userId = $user->id;
        }

        $log =
        [
            'user' => $userId,
            'parameters' => $request->Input(),
            'uri' => $request->getRequestUri(),
            'method' => $request->getMethod()
        ];

        $log = json_encode($log);
        \Log::channel('auditlog')->info($log);

        return $next($request);
    }
}
