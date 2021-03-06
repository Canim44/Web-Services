<?php
include_once("connection.php");

    // Function will calculate the cost of of a stock purchase
    function calculateStockCost($quantity, $stockArray) {
        $cost = $quantity * $stockArray[5];
        $cost = round($cost, 2);
        return $cost;
    }

    // This procedure will check to see if the balance in the user's account is sufficient
    // to cover the cost of the purchase
    function balanceSufficient(&$link, $cost, $userID) {
        // Creating a server link
        $link = serverConnection();

        $balance = getBalance($userID);

        // Return 1 if the balance is sufficient, otherwise 0
        if ($balance >= $cost) {
            return 1;
        }
        else {
            return 0;
        }
    }

    function getBalance($userID) {

        $link = serverConnection();

        $balanceQuery = "SELECT balance FROM portfolio where ID = " . $userID;

        // Executing the query
        $result = runQuery($link, $balanceQuery);

        // Parsing the data
        $balance = parseField($result, "balance", $startPosition);
        return $balance;
    }

    // This function will adjust the balance of the user's potfolio if the purchase or
    // divestment was successful
    function adjustBalance($cost, $userID, $buySell) {
        $balance = getBalance($userID);

        // Option 1 is a buy
        if ($buySell == 1) {
            $newBalance = $balance - $cost;
        }
        // Option 2 is a sale
        else if ($buySell == 2) {
            $newBalance = $balance + $cost;
        }
        $adjustmentQuery = "UPDATE portfolio SET balance = " . $newBalance . "WHERE id = " . $userID;
        $result = runNoReturnQuery($adjustmentQuery);
    }
?>
