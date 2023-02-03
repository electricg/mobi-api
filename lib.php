<?php

function get($json) {

    header('Content-Type: application/json');

    $url = "https://vancouver-gbfs.smoove.pro/gbfs/2/en/" . $json;

    echo file_get_contents($url);

}

?>