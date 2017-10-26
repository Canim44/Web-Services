<?php

include_once("parseJSON.php");
// Initialize client URL variable
$ch = curl_init();

// Variables passed in from parameters
$symbol = $_GET['symbol'];
$type = $_GET['type'];

$googleSearch = " - produced no matches.";
// Querying Google Finance to see if the symbol or company name is valid
$url = "http://finance.google.com/finance?q=" . $symbol;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$output = curl_exec($ch);

// Error checking to see if there were no matches to the search
if (strpos($output, " - produced no matches.")) {
	echo "Search failed";
}
else {
	// Checking if the user is requesting stock or stock option information
	if ($type == 1) {
		$url = "http://finance.google.com/finance?q=" . $symbol . "&output=json";
	}
	else {
		$url = "http://finance.google.com/finance/option_chain?q=" . $symbol . "&output=json";
	}
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$output = curl_exec($ch);

	if ($type == 1)
	{
		parseStock($output);
	}
	else
	{
		parseOption($ouput);
	}
}
?>
