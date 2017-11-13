<?php
include_once("connection.php");

$user = $_GET["user"];

$result = getUserID($user, NULL);
echo $result;
?>
