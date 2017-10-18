<?php
// Adding functions to validate login and connect to the server
include_once("connection.php");

$user = $_GET["user"];
$pass = $_GET["pass"];

$results = userLogin($user, $pass);

// This procedure queries the database with the username and password.
// The URL will be http://ukfl2017g2.optionapps.com/login.php?user=USERNAME&pass=PASSWORD
function userLogin($user, $pass) {
	// Creating mysqli connection
	$link = serverConnection();
	//$loginQuery = "SELECT * FROM users";
	$loginQuery = "SELECT COUNT(*) FROM users WHERE username = \"" . $user . "\" AND password = \"" . $pass . "\"";
	// Run query
	$results = runQuery($link, $loginQuery);
	// Variable to hold
	$valid = validateLogin($results);

	echo $valid;
/*
	// Function call to validate results
	if ($valid) {
		// Create query string to update last activity with CURRENT_TIMESTAMP
		$activeQuery = "UPDATE users SET lastActivity = CURRENT_TIMESTAMP() WHERE username = \"" . $user . "\"";
		echo $activeQuery;
		// Error checking if update query fails.
		if (!$rs = mysqli_query($link, $activeQuery)) {
			die("Error: Could not update last activity");
		}
	}
*/
	// This procedure takes the results from the login query and validates if a login was successful
	function validateLogin($results) {
		$authenticated = "[{\"COUNT(*)\":\"1\"}]";

		if ($results == $authenticated) {
			echo "Login successful";
		}
		else {
			die("Fail: Username/password combination not found");
		}
	}
?>
