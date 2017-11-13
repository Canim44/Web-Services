<?php
    include_once("parseJSON.php");
    include_once("calculations.php");
    include_once("portfolio.php");

    // Variables passed in from parameters
    $symbol = $_GET["symbol"];
    $quantity = $_GET["quantity"];
    $user = $_GET["user"];
    $loginKey = $_GET["loginkey"];
    $buyDate = $_GET["buydate"];

    // Initialize client URL variable
    $ch = curl_init();

    $stockOption = 1;
    $userID = getUserID($user, $loginKey);

    // Ping Google Finance to get the latest up to date infromation
    $url = "http://finance.google.com/finance?q=" . $symbol . "&output=json";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($ch);

    $stockArray = parseStock($output);

    $quantityRemaining = getQuantity($userID, $buyDate, $symbol, $stockOption);
    if ($quantityRemaining >= $quantity) {
        $newQuantity = $quantityRemaining - $quantity;
        $total = calculateStockCost($quantity, $stockArray);
        $success = executeSale($total, $stockArray, $userID, $newQuantity, $stockOption, $buyDate);
        if ($success == 1) {
            $adjustment = adjustBalance($total, $userID, 2);
        }
    }
    else {
        echo "Invalid quantity of stock to be sold.";
    }
?>