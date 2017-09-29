<?php

	$ch = curl_init();
	$symbol = $_GET['argument1'];
$url = "http://finance.google.com/finance/option_chain?q=" . $symbol . "&output=json";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$output = curl_exec($ch);
echo output;
?>
