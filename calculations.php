<?php
include_once("connection.php");

    // Function will calculate the cost of of a stock purchase
    function calculateStockCost($quantity, $stockArray) {
        return $quantity * $stockArray[5];
    }

    // This procedure will check to see if the balance in the user's account is sufficient
    // to cover the cost of the purchase
    function balanceSufficient(&$link,$cost, $userID) {
        $startPosition = 0;
        // Creating a server link
        $link = serverConnection();
        // Creating the query to check the balance.
        $balanceQuery = "SELECT balance FROM portfolio where ID = " . $userID;

        // Executing the query
        $result = runQuery($link, $balanceQuery);

        // Parsing the data
        $balance = parseField($result, "balance", $startPosition);

        // Return 1 if the balance is sufficient, otherwise 0
        if ($balance >= $cost) {
            return 1;
        }
        else {
            return 0;
        }
    }
    function getBalance(&$link, $user, $loginKey) {
        $balanceQuery = "SELECT balance FROM portfolio where ID = " . $userID;

        // Executing the query
        $result = runQuery($link, $balanceQuery);

        // Parsing the data
        $balance = parseField($result, "balance", $startPosition);
    }
    // This function will adjust the balance of the user's potfolio if the purchase or
    // divestment was successful
    function adjustBalance($cost, $user, $loginKey) {

        $adjustmentQuery = "UPDATE portfolio SET balance = " .
        if ($user != NULL) {

        }
        else {

        }
    }

?>
