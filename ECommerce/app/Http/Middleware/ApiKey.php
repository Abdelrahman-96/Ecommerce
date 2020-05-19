<?php

namespace App\Http\Middleware;

use Closure;

class ApiKey
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
        $token = $request->header('API_KEY');
        if($token != 'ABCDEFG')
        {
            return response()->json(['message' => 'Auth filled'], 401);
        }
        return $next($request);
    }
}
