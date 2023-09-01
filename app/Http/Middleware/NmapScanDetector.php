<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NmapScanDetector
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
        $signature = '/Nmap/';
        $userAgent = $request->header('User-Agent');

        if (preg_match($signature, $userAgent)) {
            // Log the nmap scan
            Log::warning('Nmap scan detected from IP: ' . $request->ip());
        }

        return $next($request);
    }
}
