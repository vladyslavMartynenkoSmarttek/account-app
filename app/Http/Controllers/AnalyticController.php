<?php

    namespace App\Http\Controllers;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Http\Request;
    use Inertia\Inertia;
    use Inertia\Response;

    class AnalyticController extends Controller
    {
        //
        public function index(Request $request): Response
        {
            //read access_log file from /opt/homebrew/var/log/access_log.log


            $lines = self::getLogs();

            return Inertia::render('Analytic/Index', [
                'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
                'status' => session('status'),
                'lines' => $lines,
            ]);
        }

        public static function getLogs()
        {
            $file = '/opt/homebrew/var/log/httpd/access_log';
            $lines = file($file);
            $lines = array_reverse($lines);

            //get the last 10 lines
            $lines = array_slice($lines, 0, 100);

            //convert lines to array with keys IP,Date,Method,URL
            foreach ($lines as $key => $line) {
                $line = explode(' ', $line);
                if ($line[0] === '127.0.0.1' or $line[0] === '45.89.88.115'){
                    continue;
                }
                $lines[$key] = [
                    'ip' => $line[0],
                    'date' => $line[3] . ' ' . $line[4],
                    'method' => str_replace('"','',$line[5]),
                    'url' => $line[6],
                ];
            }

            return $lines;
        }

    }
