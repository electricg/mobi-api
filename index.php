<?php

// Show all information, defaults to INFO_ALL
// phpinfo();

$url = "https://vancouver-gbfs.smoove.pro/gbfs/2/en/station_status.json";

echo file_get_contents($url);

?>