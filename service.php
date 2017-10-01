<?php
	// Adding functions to validate login and connect to the server
	require_once("connection.php");

// 	// Variables for connection strings
// 	$servername = "localhost";
// 	$serveruser = "ukfl2017g2";
// 	$serverpass = "Ekwi32D98";
//
// 	/* Include the header file for JSON services and library
// include_once("JSON.php");
//
// Initiating the JSON service
// $json = new Services_JSON();
// */
// // Initializing the link to the MySQL database
// 	$link = mysqli_connect($servername, $serveruser, $serverpass) or die("Error: Connection to Server failed");
// 	mysqli_select_db($link, "ukfl2017g2") or die("Error: Database");

	// Creating link to the server
	//$link = serverConnection();
	//$arr = array();
	$user = $_GET["user"];
	$pass = $_GET["pass"];

	$results = databaseConnection($user, $pass);
	// //$loginQuery = "SELECT * FROM users";
	// $loginQuery = "SELECT COUNT(*) FROM users WHERE username = \"" . $user . "\" AND password = \"" . $pass . "\"";
	//
	// $rs = mysqli_query($link, $loginQuery);
	//
	// while($obj = mysqli_fetch_object($rs)) {
	// 	$arr[] = $obj;
	// }
	// $results = json_encode($arr);
	// $stuff = validateLogin($results);
?>
