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
    $cost = calculateStockCost($quantity, $stockArray);

    // Call to execute the purchase of the stock
    $success = executePurchase($cost, $stockArray, $user, $loginKey, 1);

?>
