<?php

function get($json) {
    header('Content-Type: application/json; charset=utf-8');

    $request_headers        = apache_request_headers();
    $http_origin            = $request_headers['Origin'];
    $allowed_http_origins   = array(
        "http://localhost:8080",
    );
    if (in_array($http_origin, $allowed_http_origins)){  
        @header("Access-Control-Allow-Origin: " . $http_origin);
    }
    // header('Access-Control-Allow-Origin: *');

    $url = "https://vancouver-gbfs.smoove.pro/gbfs/2/en/" . $json;
    echo file_get_contents($url);

}

?>