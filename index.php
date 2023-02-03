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

$requested = $_SERVER['REQUEST_URI'];

if (!in_array($requested, $allowed_jsons)) {
    http_response_code(404);
    // echo '{"error":"Not Found"}';
    echo $requested;
    exit();
}

// $request_headers        = apache_request_headers();
// $http_origin            = $request_headers['Origin'];
// $allowed_http_origins   = array(
//     'http://localhost:8080',
//     'https://giulia.dev',
//     'https://giugee.com/',
//     'https://electricg.github.io',
// );
// if (in_array($http_origin, $allowed_http_origins)) {  
//     @header('Access-Control-Allow-Origin: ' . $http_origin);
// }
// // header('Access-Control-Allow-Origin: *');

// $url = 'https://vancouver-gbfs.smoove.pro/gbfs/2/en/' . $json;
// echo file_get_contents($url);

?>