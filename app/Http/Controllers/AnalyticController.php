<?php

    namespace App\Http\Controllers;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;
    use Inertia\Inertia;
    use Inertia\Response;

    class AnalyticController extends Controller
    {
        //
        public function index(Request $request): Response
        {
            //read access_log file from /opt/homebrew/var/log/access_log.log


            $lines = self::getLogs($request);

            return Inertia::render('Analytic/Index', [
                'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
                'status' => session('status'),
                'lines' => $lines,
            ]);
        }

        public static function getLogs(Request $request)
        {
            $file = storage_path('logs/requests.log');
            $lines = file($file);
            $return_lines = [];
            //get the last 10 lines
//            $lines = array_slice($lines, 0, 10000);

            //convert lines to array with keys IP,Date,Method,URL
            foreach ($lines as $key => $line) {

                $position_bracket = strpos($line, '{');
                $json_line = substr($line, $position_bracket);
                $json_line = substr($json_line, 0, -2);
                $json_line = json_decode($json_line);

//                $json_line = (object) $json_line;


                if ($json_line->IP === '45.89.88.115') {
                    continue;
                }

                /*
                 *  $log = [
                           + 'METHOD' => $request->getMethod(),
                          +  'REQUEST_BODY' => $request->all(),
                           + 'REQUEST_URI' => $request->getRequestUri(),
                           + 'IP' => $request->ip(),
                            'PORT' => $request->getPort(),
                            'SCHEME' => $request->getScheme(),
                           + 'DATE' => date('Y-m-d H:i:s')
                        ];
                 */

                $body = '';
                if (isset($json_line->REQUEST_BODY) and $json_line->REQUEST_BODY) {
                    $body = implode('; ', array_map(
                        function ($v, $k) {
                            return $k . ':' . $v;
                        },
                        (array)$json_line->REQUEST_BODY,
                        array_keys((array)$json_line->REQUEST_BODY)
                    ));
                }

                $lines[$key] = [
                    'ip' => $json_line->IP ?? '',
                    'date' => $json_line->DATE ?? '',
                    'method' => $json_line->METHOD ?? '',
                    'url' => $json_line->REQUEST_URI ?? '',
                    'body' => $body ?? '',
                    'scheme' => $json_line->SCHEME ?? '',
                    'port' => $json_line->PORT ?? ''
                ];
            }


            return $lines;
        }

    }
