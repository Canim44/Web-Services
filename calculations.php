<?php
include_once("connection.php");

function calculateCost($quantity, $stockArray) {
    return $quantity * $stockArray[4];
}

function balanceSufficient($cost) {
    $link = serverConnection();
    $loginQuery = "SELECT balance FROM portfolio where username = \"" . $user . "\"";

    $result = runQuery($link, $loginQuery);

    echo $result;
}

function putStrikePrice($optionArray) {

}
?>
