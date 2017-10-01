<?php

// Adding functions to validate login and connect to the server
include_once("connection.php");
login();

function login() {
	$user = $_GET["user"];
	$pass = $_GET["pass"];

	$results = userLogin($user, $pass);
	echo $results;
}

// This procedure queries the database with the username and password.
function userLogin($user, $pass) {
	// Creating mysqli connection
	$link = serverConnection();
	//$loginQuery = "SELECT * FROM users";
	$loginQuery = "SELECT COUNT(*) FROM users WHERE username = \"" . $user . "\" AND password = \"" . $pass . "\"";
	// Run query
	$results = runQuery($link, $loginQuery);
	// Variable to hold
	$valid = validateLogin($results);

	// Function call to validate results
	if ($valid) {
		// Create query string to update last activity with CURRENT_TIMESTAMP
		$activeQuery = "UPDATE users SET lastActivity = CURRENT_TIMESTAMP() WHERE username = \"" . $user . "\"";
		// Error checking if update query fails.
		if (!$rs = mysqli_query($link, $activeQuery)) {
			die("Error: Could not update last activity");
		}
	}

}

// This procedure standardizes the way queries are run with the results formatted in json
// $link and $query are set up in the caller function
function runQuery(&$link, $query) {

	// Creating query object
	$rs = mysqli_query($link, $query);

	// Fetch the results and place into an object
	while($obj = mysqli_fetch_object($rs)) {
		$arr[] = $obj;
	}
	// Encode the results into a json type object
	$results = json_encode($arr);
echo $results;
}

// This procedure takes the results from the login query and validates if a login was successful
function validateLogin($results) {
	$authenticated = "[{\"COUNT(*)\":\"1\"}]";

	if ($results == $authenticated) {
		return 1;
	}
	else {
		return 0;
	}
}
?>
