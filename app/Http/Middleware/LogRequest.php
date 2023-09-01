<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (app()->environment('local')) {
            $log = [
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'REQUEST_URI' => $request->getRequestUri(),
                'IP' => $request->ip(),
                'PORT' => $request->getPort(),
                'SCHEME' => $request->getScheme(),
                'DATE' => date('Y-m-d H:i:s')
            ];

            Log::channel('requests')->info(json_encode($log));
        }

        return $response;
    }
}
