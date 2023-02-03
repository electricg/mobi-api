<?php

header('Content-Type: application/json; charset=utf-8');

$allowed_jsons = array(
    'gbfs_versions.json',
    'system_information.json',
    'station_information.json',
    'station_status.json',
    'vehicle_types.json',
    'free_bike_status.json',
);

$folder = '/mobi-api/';

$remote_url = 'https://vancouver-gbfs.smoove.pro/gbfs/2/en/';

$allowed_http_origins   = array(
    'http://localhost:8080',
    'https://giulia.dev',
    'https://giugee.com/',
    'https://electricg.github.io',
);

$requested = $_SERVER['REQUEST_URI'];
$parsed_requested = str_replace($folder, '', $requested);

if (!in_array($parsed_requested, $allowed_jsons)) {
    http_response_code(404);
    echo '{"error":"Not Found"}';
    exit();
}

$request_headers        = apache_request_headers();
$http_origin            = $request_headers['Origin'];

if (in_array($http_origin, $allowed_http_origins)) {  
    @header('Access-Control-Allow-Origin: ' . $http_origin);
}
// header('Access-Control-Allow-Origin: *');

$url = $remote_url . $parsed_requested;
echo file_get_contents($url);

?>