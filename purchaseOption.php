<?php
    include_once("parseJSON.php");
    include_once("calculations.php");
    include_once("portfolio.php");

    // Initialize client URL variable
    $ch = curl_init();

    $type = $_GET["type"];
    $symbol = $_GET["symbol"];
    $user = $_GET["user"];
    $loginKey = $_GET["loginkey"];
    $quantity = $_GET["quantity"];
    $optionID = $_GET["quantity"];

    $userID = getUserID($user, $loginKey);

    $stockOption = 2;

    $url = "http://finance.google.com/finance/option_chain?q=" . $symbol . "&output=json";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($ch);

    
?>
