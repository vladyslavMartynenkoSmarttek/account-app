<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AttackDetector
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
        // Get the request IP address
        $ip = $request->ip();

        // Check for SQL injection attack
        if (preg_match("/union|select|insert|drop|update|delete|exec|convert|truncate|declare|alert|char|database|script|javascript|iframe|img|onerror|onload/i", $request->getQueryString() . $request->getContent())) {
            abort(403, 'SQL injection attack detected');
        }

        // Check for cross-site scripting attack
        if (preg_match("/<script>|<\/script>|<iframe>|<\/iframe>|<object>|<\/object>|<embed>|<\/embed>|<applet>|<\/applet>|<meta>|<link>|<style>|<\/style>|javascript:/i", $request->getQueryString() . $request->getContent())) {
            abort(403, 'Cross-site scripting attack detected');
        }

        // Check for remote file inclusion attack
        if (preg_match("/http|https|ftp|ftps|scp|sftp|rsync|www/i", $request->getQueryString() . $request->getContent())) {
            abort(403, 'Remote file inclusion attack detected');
        }

        // Check for shell injection attack
        if (preg_match("/\||`|>|<|&|&&|\n|\r|\t/i", $request->getQueryString() . $request->getContent())) {
            abort(403, 'Shell injection attack detected');
        }

        // Check for CSRF attack
        if ($request->isMethod('post') && $request->headers->get('referer') != $request->getSchemeAndHttpHost() . $request->getPathInfo()) {
            abort(403, 'Cross-site request forgery attack detected');
        }

        // Check for Laravel Ignition attack
        $path = $request->path();
        if (strpos($path, '_ignition') !== false) {
            abort(403, 'Laravel Ignition attack detected');
        }

        //check for shell attack in request uri
        $path = $request->path();
        if (strpos($path, 'shell') !== false) {
            abort(403, 'Shell attack detected');
        }

        // Check if the request path matches the attack URL (don't work )
        if ($request->path() === 'config/getuser') {
            abort(403, 'Config not allowed');
        }


        $folderIds = $request->query('/folderIds');
        // Check if folderIds contains non-digit characters
//        if (!ctype_digit($folderIds)) {
//            return response('Folders not allowed', 403);
//        }

        // Check for Exchange ECP attack
        if (str_contains($request->url(), '/ecp/Current/exporttool/microsoft.exchange.ediscovery.exporttool.application')) {
            return response('ECP Attacked detect', 403);
        }

        // Check for XDEBUG attack
        if ($request->has('XDEBUG_SESSION_START')) {
            abort(403, 'Xdebug session start parameter is not allowed.');
        }

        // Check request in not route list
        $routeList = Route::getRoutes();
        if ($routeList->match($request) === null) {
            abort(403, 'Route not allowed');
        }

        return $next($request);
    }
}
