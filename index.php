<?php
header('Content-Type: application/json; charset=utf-8');

$remote_url = 'https://vancouver-gbfs.smoove.pro/gbfs/2/en/';
$allowed_jsons = array(
    'gbfs_versions.json',
    'system_information.json',
    'station_information.json',
    'station_status.json',
    'vehicle_types.json',
    'free_bike_status.json',
);
$local_folder = '/mobi-api/';
$allowed_http_origins = array(
    'https://giulia.dev',
    'https://giugee.com',
    'https://electricg.github.io',
);

$request_headers = apache_request_headers();
$http_origin = $request_headers['Origin'];

if (in_array($http_origin, $allowed_http_origins) || preg_match("/^http:\/\/localhost(:\d+)?$/", $http_origin)) {
    header('Access-Control-Allow-Origin: ' . $http_origin);
}

$parsed_requested = str_replace($local_folder, '', $_SERVER['REQUEST_URI']);

if (!in_array($parsed_requested, $allowed_jsons)) {
    http_response_code(404);
    echo '{"error":"Not Found"}';
    exit();
}

echo file_get_contents($remote_url . $parsed_requested);
?>