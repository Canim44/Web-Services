<?php
    include_once("parseJSON.php");
    include_once("calculations.php");
    include_once("portfolio.php");

    // Initialize client URL variable
    $ch = curl_init();

    // Variables passed in from parameters
    //$cid = $_GET["cid"];

    $type = $_GET["type"];
    $symbol = $_GET["symbol"];
    // $quantity = $_GET["quantity"];
    // $user = $_GET["user"];
    // $loginKey = $_GET["loginkey"];
    // $underlyingID = $_GET["underlying"];
    //
    // $userID = getUserID($user, $loginKey);



?>
