<?php

// Adding functions to validate login and connect to the server
include_once("connection.php");
login();

function login() {
	$user = $_GET["user"];
	$pass = $_GET["pass"];

	$results = databaseConnection($user, $pass);
	echo $results;
}
?>
