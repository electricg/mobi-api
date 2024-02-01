<?php
header('Content-Type: application/json; charset=utf-8');

$REMOTE_URL = 'https://vancouver-gbfs.smoove.pro/gbfs/2/en/';
$ALLOWED_JSONS = array(
    'gbfs_versions.json',
    'system_information.json',
    'station_information.json',
    'station_status.json',
    'vehicle_types.json',
    'free_bike_status.json',
);
$ALLOWED_HTTP_ORIGINS = array(
    'https://giulia.dev',
    'https://giugee.com',
    'https://electricg.github.io',
);
$IS_LOCALHOST_ALLOWED = true;

$request_headers = apache_request_headers();
$http_origin = $request_headers['Origin'];

if (
        in_array($http_origin, $ALLOWED_HTTP_ORIGINS) ||
        ($IS_LOCALHOST_ALLOWED && preg_match("/^http:\/\/localhost(:\d+)?$/", $http_origin))
    ) {
    header('Access-Control-Allow-Origin: ' . $http_origin);
}

$uri_parts = explode('?', $_SERVER['REQUEST_URI']);
$uri_folders = explode('/', $uri_parts[0]);
$parsed_requested = array_pop($uri_folders);

if (!in_array($parsed_requested, $ALLOWED_JSONS)) {
    http_response_code(404);
    echo '{"error":"Not Found"}';
    exit();
}

echo file_get_contents($REMOTE_URL . $parsed_requested);
?>