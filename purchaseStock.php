<?php
    include_once("parseJSON.php");
    include_one("calculations.php");

    // Initialize client URL variable
    $ch = curl_init();

    // Variables passed in from parameters
    $symbol = $_GET["symbol"];
    $quantity = $_GET["quantity"];

    $googleSearch = " - produced no matches.";
    // Querying Google Finance to see if the symbol or company name is valid
    $url = "http://finance.google.com/finance?q=" . $symbol;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($ch);

    $url = "http://finance.google.com/finance?q=" . $symbol . "&output=json";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($ch);

    // Error checking to see if there were no matches to the search
	if (strpos($output, " - produced no matches.")) {
		echo "Search failed";
	}
    else {
        $stockArray = parseStock($output);
        for ($i = 0; $i < 9; $i++) {
        	echo "<br>" . $stockArray[$i] . "</br>";
        }
    }

    $cost = calculateCost($quantity);

    function executePurchase($cost, $stockArray) {

    }

    // Meaning of each index
    // 0 = SYMBOL
    // 1 = EXCHANGE
    // 2 = COMPANY NAME
    // 3 = CHANGE IN PRICE
    // 4 = PRICE
    // 5 = CHANGE PERCENT
    // 6 = OPENING PRICE
    // 7 = INTRADAY HIGH
    // 8 = INTRADAY LOW
?>
