<?php

    include_once("parseJSON.php");
    include_once("calculations.php");

    // Initialize client URL variable
    $ch = curl_init();

    // Variables passed in from parameters
    $symbol = $_GET["symbol"];
    $quantity = $_GET["quantity"];
    $user = $_GET["user"];
    $loginKey = $_GET["loginkey"];

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
    }

    $cost = calculateCost($quantity, $stockArray);

    $success = executePurchase($cost, $stockArray, $user, $loginKey);


    function executePurchase($cost, $stockArray, $user, $loginKey) {
        $link = serverConnection();

        $getIDQuery = "SELECT id FROM users WHERE ";
        if ($user != NULL) {
            $getIDQuery = $getIDQuery . " username = \"" . $user . "\"";
            echo $getIDQuery;
            $userID = runQuery($link, $getIDQuery);
            echo $userID;
        }
        else if ($loginKey != NULL) {
            $getIDQuery = $getIDQuery . " loginkey = \"" . $loginKey . "\"";
            echo $getIDQuery;
        }


    }
?>
