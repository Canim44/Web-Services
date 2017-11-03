<?php

include_once("connection.php");
include_once("calculations.php");

// Function executes the purchase, with branches for the purchase of stocks or options
function executePurchase($cost, $stockArray, $userID, $quantity, $stockOption) {
    // Creating a database connection
    $link = serverConnection();

    // Call the balanceSufficient() function in order to ensure
    // there is enough money in the portfolio to make the purchase
    $balance = balanceSufficient($link, $cost, $userID);

    // If the balance is sufficient
    if ($balance == 1) {
        // If the $stockOption variable is set to '1' which indicates a stock
        if ($stockOption == 1) {
            $purchaseQuery = "INSERT INTO stocks (id, stockID, symbol, price, quantity, quantityRemaining, dateBought) VALUES ("
                . $userID . ", ". $stockArray[2] . ", \"" . $stockArray[0] . "\", " . $stockArray[5] . ", ". $quantity . ", " . $quantity . ", CURRENT_TIMESTAMP())";
            $result = runBuySellQuery($purchaseQuery);

            return $result;
        }
        if ($stockOption == 2) {
            $purchaseQuery = "INSERT INTO options (id, stockID, symbol, buyPrice, quantity, quantityRemaining, strikePrice, expiration, buyDate, sellDate, callOrPut) VALUES (";
        }

    }
    else {
        echo "Insufficient funds";
        return 0;
    }
}

function executeSale($cost, $stockArray, $userID, $newQuantity, $stockOption, $buyDate) {
    // Creating a database connection
    $link = serverConnection();
    if ($stockOption == 1) {
        $saleQuery = "UPDATE stocks SET dateSold = CURRENT_TIMESTAMP(), quantityRemaining = " . $newQuantity . " WHERE stockID = " . $stockArray[2] . " AND dateBought = \"" . $buyDate . "\" AND id = ". $userID;
        $result = runBuySellQuery($saleQuery);
    }
    if ($result == 1) {
        $success = adjustBalance($cost, $userID, 2);
    }
}

function getQuantity($userID, $buyDate, $symbol, $stockOption) {
    $link = serverConnection();

    if ($stockOption == 1) {
        $table = "stocks";
    }
    else {
        $table = "portfolio";
    }
    $startPosition = 0;
    $quantityQuery = "SELECT quantityRemaining FROM " . $table . " WHERE id = " . $userID . " AND symbol = \"" . $symbol . "\" AND dateBought = \"" . $buyDate . "\"";
    $quantity = runQuery($link, $quantityQuery);
    $quantity = parseField($quantity, "quantityRemaining", $startPosition);
    return $quantity;
}
?>
