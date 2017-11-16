<?php
include_once("connection.php");
error_reporting(~E_WARNING); // supression for bad ticker

$symbol = $_GET['symbol'];

// Grab file from Google Finance API, map to array, and encode to JSON
$file = 'http://www.google.com/finance/historical?q=NASDAQ:' 
	. $symbol 
	. '&startdate=Jan+01%2C+2000&output=csv';
// Returns FALSE if file not found & dies; otherwise, assigns to $csv
if (!($csv = file_get_contents($file))) {
	die("Ticker not found");
$array = array_map("str_getcsv", explode("\n", $csv));
$json = json_encode($array);
print_r($json);
?>
