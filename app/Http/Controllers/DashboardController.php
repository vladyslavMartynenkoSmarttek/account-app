<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index() : Response
    {
        $markers = $this->getMapMarkers();

        return Inertia::render('Dashboard', [
           'mapMarkers' => $markers,
        ]);
    }

    public function getMapMarkers (): array
    {
        //get logs
        $file = storage_path('logs/requests.log');
        $lines = file($file);
        $lines = array_reverse($lines);
        $return_lines = [];

        //get all lines
        foreach ($lines as $key => $line) {
            $position_bracket = strpos($line, '{');
            $json_line = substr($line, $position_bracket);
            $json_line = substr($json_line, 0, -2);
            $json_line = json_decode($json_line);

            //get ip
            $ip = $json_line->IP;

            if (strpos($ip, '192.168') !== false) {
                continue;
            }
            //skip 127.0.0.1
            if (strpos($ip, '127.0.') !== false) {
                continue;
            }
            //skip
            if (strpos($ip, '45.89.') !== false) {
                continue;
            }

            $return_lines[] = $ip;
        }

        //get unique ips
        $unique_ips = array_unique($return_lines);

        //get only 5
        $unique_ips = array_slice($unique_ips, 0, 3);
        //get lat and long
        $lat_long = [];
        foreach ($unique_ips as $ip) {
            //skip local ips

            $details = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));

            if (empty($details->lat) or empty($details->lon)) {
                continue;
            }
            $lat_long[$ip]['lat'] = $details->lat;
            $lat_long[$ip]['lon'] = $details->lon;
            $lat_long[$ip]['city'] = $details->city;
        }

        //get map markers
        $map_markers = [];
        foreach ($lat_long as $key => $value) {
            $map_markers[] = [
                'lat' => $value['lat'],
                'lng' => $value['lon'],
                'city' => $value['city'],
            ];
        }
        return $map_markers;
    }
}
