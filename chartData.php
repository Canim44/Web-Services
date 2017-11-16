<?php
include_once("connection.php");

$symbol = $_GET['symbol'];

// Grab file from Google Finance API, map to array, and encode to JSON
$file = 'http://www.google.com/finance/historical?q=NASDAQ:' . symbol . '&startdate=Jan+01%2C+2000&output=csv';
$csv = file_get_contents($file);
$array = array_map("str_getcsv", explode("\n", $csv));
$json = json_encode($array);
print_r($json);
?>
