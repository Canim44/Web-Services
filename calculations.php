<?php
include_once("connection.php");

    // Function will calculate the cost of of a stock purchase
    function calculateStockCost($quantity, $stockArray) {
        return $quantity * $stockArray[4];
    }

    function balanceSufficient(&$link,$cost, $userID) {
        $link = serverConnection();
        $balanceQuery = "SELECT balance FROM portfolio where ID = " . $userID;

        $result = runQuery($link, $balanceQuery);

        $balance = parseField($result, "balance");

        if ($balance >= $cost) {
            return 1;
        }
        else {
            return 0;
        }
    }


    function executePurchase($cost, $stockArray, $user, $loginKey, $stockOption) {
        $link = serverConnection();
        $userID = 0;
        // Query to retrieve the ID value from the server
        $getIDQuery = "SELECT id FROM users WHERE ";

        // If the app passed in the username, use it to get the ID
        if ($user != NULL) {
            $getIDQuery = $getIDQuery . " username = \"" . $user . "\"";
            $userID = runQuery($link, $getIDQuery);
            $userID = parseField($userID, "id");
            echo $userID;
        }
        // If the app passed in the loginKey, use it to get the ID
        else if ($loginKey != NULL) {
            $getIDQuery = $getIDQuery . " loginkey = \"" . $loginKey . "\"";
            $userID = runQuery($link, $getIDQuery);
            $userID = parseField($userID, "id");
        }

        $balance = balanceSufficient($link, $cost, $userID);

        if ($balance == 1) {

        }
    }
?>
