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
         * @param \Illuminate\Http\Request $request
         * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
         * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
         */
        public function handle(Request $request, Closure $next)
        {
            $needestCountry = 'Ukraine';

            //new guzzle request
            $client = new Client();

            //if IP_GEO_DEVELOPMENT if contain some value, then we use it as IP for request
            if (env('IP_GEO_DEVELOPMENT')) {
                $response = $client->request('GET', 'http://ip-api.com/json/' . env('IP_GEO_DEVELOPMENT'));
            } else {
                $response = $client->request('GET', 'http://ip-api.com/json/' . $request->ip());
            }

            $country = json_decode($response->getBody()->getContents())->country;

            if ($country !== $needestCountry) {
                abort(403, 'The russian warship went to hell');
            }

            return $next($request);
        }
    }
