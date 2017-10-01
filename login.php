<?php

// Adding functions to validate login and connect to the server
require_once("connection.php");

function login() {
	$user = $_GET["user"];
	$pass = $_GET["pass"];

	$results = databaseConnection($user, $pass);
}
?>
