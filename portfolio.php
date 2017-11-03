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
            $purchaseQuery = "INSERT INTO stocks (id, stockID, symbol, price, quantity, dateBought) VALUES ("
                . $userID . ", ". $stockArray[2] . ", \"" . $stockArray[0] . "\", " . $stockArray[5] . ", ". $quantity . ", CURRENT_TIMESTAMP())";
                echo $purchaseQuery;
            $result = runBuySellQuery($purchaseQuery);
            return $result;
        }
        if ($stockOption == 2) {
            $purchaseQuery = "INSERT INTO options (id, stockID, symbol, buyPrice, quantity, strikePrice, expiration, buyDate, sellDate, callOrPut) VALUES (";
        }
    }
    else {
        echo "Insufficient funds";
        return 0;
    }
}
?>
