<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;

    class BlockIpMiddleware
    {
        //get ips from env
        public $blockIps = [];

        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
         * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
         */
        public function handle(Request $request, Closure $next)
        {
            $serverLogs = collect($request->server())->map(function ($value, $key) {
                return "{$key}: {$value}";
            })->toArray();

            $method = strtoupper($request->getMethod());

            $uri = $request->getPathInfo();

            $bodyAsJson = json_encode($request->except(config('http-logger.except')));

            $message = "{$method} {$uri} - {$bodyAsJson}";

            Log::channel(config('http-logger.log_channel'))->info($message);

            if (in_array($request->ip(), $this->blockIps)) {
                abort(403, "You are restricted to access the site.");
            }

            return $next($request);
        }
    }
