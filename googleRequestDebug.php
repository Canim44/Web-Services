<?php

include_once("parseJSON.php");

	// Variables passed in from parameters
	$symbol = $_GET['symbol'];
	$type = $_GET['type'];

	$file_handle = fopen("C:\\Users\\a422865\\Documents\\GitHub\\Web-Services\\json.txt", "r");
	$output = "";
	$stockOutput = "";
	while (!feof($file_handle)) {
		$output = $output . fgets($file_handle);
	}
	fclose($file_handle);
	$file_handle = fopen("C:\\Users\\a422865\\Documents\\GitHub\\Web-Services\\f.txt", "r");

	while (!feof($file_handle)) {
		$stockOutput = $stockOutput . fgets($file_handle);
	}

	$file_handle = fopen("C:\\Users\\a422865\\Documents\\GitHub\\Web-Services\\f.txt", "r");

		// Checking if the user is requesting stock or stock option information
		if ($type == 1) {
			$url = "http://finance.google.com/finance?q=" . $symbol . "&output=json";
		}
		else {
			$url = "http://finance.google.com/finance/option_chain?q=" . $symbol . "&output=json";
		}

		if ($type == 1)
		{
	//		$stockarray = parseStock($output);
		}
		else if ($type == 2) {
	//		$url = "http://finance.google.com/finance?q=" . $symbol . "&output=json";
	//		curl_setopt($ch, CURLOPT_URL, $url);
	//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			$stockArray = parseStock($stockOutput);

			parseOption($output, $stockArray);
		}
?>
