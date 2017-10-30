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


    // Query Google Finance to get the latest up to date infromation
    $url = "http://finance.google.com/finance?q=" . $symbol . "&output=json";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($ch);

    // Parse the JSON file to get the price of the stock
    $stockArray = parseStock($output);

    // Calculate the cost of the purchase at current market prices
    $cost = calculateCost($quantity, $stockArray);

    // Call to execute the purchase of the stock
    $success = executePurchase($cost, $stockArray, $user, $loginKey);

    function executePurchase($cost, $stockArray, $user, $loginKey) {
        $link = serverConnection();
        $userID = 0;
        // Query to retrieve the ID value from the server
        $getIDQuery = "SELECT id FROM users WHERE ";

        // If the app passed in the username, use it to get the ID
        if ($user != NULL) {
            $getIDQuery = $getIDQuery . " username = \"" . $user . "\"";
            $userID = runQuery($link, $getIDQuery);
            $userID = parseID($userID);
        }
        // If the app passed in the loginKey, use it to get the ID
        else if ($loginKey != NULL) {
            $getIDQuery = $getIDQuery . " loginkey = \"" . $loginKey . "\"";
            $userID = runQuery($link, $getIDQuery);
            $userID = parseID($userID);
        }

                
    }
    // Function to parse the user ID out of the returned value from the SQL server
    function parseID($userID) {
        $startPosition = 8;
        $endPosition = strpos($userID, "\"", $startPosition);
        $ID = substr($userID, $startPosition, $endPosition - $startPosition);
        return $ID;
    }
?>
