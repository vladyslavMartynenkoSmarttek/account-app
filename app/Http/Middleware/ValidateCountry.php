<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ValidateCountry
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
       $needestCountry = 'Ukraine';

       //new guzzle request
         $client = new Client();

         $response = $client->request('GET', 'http://ip-api.com/json/' . $request->ip());
//         $response = $client->request('GET', 'http://ip-api.com/json/' . '45.89.88.115');

         $country = json_decode($response->getBody()->getContents())->country;

         if ($country !== $needestCountry) {
                return response()->json(['message' => 'the russian warship went to hell'], 403);
         }

        return $next($request);
    }
}
