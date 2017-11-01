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

    function executePurchase($cost, $stockArray, $user, $loginKey, $quantity, $stockOption) {
        $link = serverConnection();
        $userID = 0;
        // Query to retrieve the ID value from the server
        $getIDQuery = "SELECT id FROM users WHERE ";
        $startPosition = 0;

        // If the app passed in the username, use it to get the ID
        if ($user != NULL) {
            $getIDQuery = $getIDQuery . " username = \"" . $user . "\"";
            $userID = runQuery($link, $getIDQuery);
            $userID = parseField($userID, "id", $startPosition);
        }
        // If the app passed in the loginKey, use it to get the ID
        else if ($loginKey != NULL) {
            $getIDQuery = $getIDQuery . " loginkey = \"" . $loginKey . "\"";
            $userID = runQuery($link, $getIDQuery);
            $userID = parseField($userID, "id", $startPosition);
        }

        $balance = balanceSufficient($link, $cost, $userID);

        if ($balance == 1) {
            if ($stockOption == 1) {
                $date =
                $purchaseQuery = "INSERT INTO stocks (id, stockID, symbol, price, quantity, dateBought) VALUES ("
                    . $userID . ", ". $stockArray[2] . ", \"" . $stockArray[0] . "\", " . $stockArray[5] . ", ". $quantity . ", CURRENT_TIMESTAMP())";
                    echo $purchaseQuery;
                $result = runBuySellQuery($link, $purchaseQuery);
                return $result;
            }
        }
        else {
            echo "Insufficient funds";
            return 0;
        }
    }
?>
