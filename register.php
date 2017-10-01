<?php
  // Include the functions provided in "connection.php"
  require_once("connection.php");

  // Get parameters passed into the script
  $username = $_GET["username"];
  $password = $_GET["password"];

  $link = serverConnection();

  if (!checkUserExists) {
    die("Error: Username already exists");
  }





  function checkUserExists($usernam, &$link) {
    // Query to check if anything is returned when trying to match by username
    $query = "SELECT * FROM users WHERE username = \"" . $username . "\"";
    $rs = mysqli_query($link, $query);

    
  }

?>
// This procedure queries the database with the username and password.
function databaseConnection($user, $pass) {
  // Creating mysqli connection
  $link = serverConnection();

  //$loginQuery = "SELECT * FROM users";
  $loginQuery = "SELECT COUNT(*) FROM users WHERE username = \"" . $user . "\" AND password = \"" . $pass . "\"";

  // Creating query to validate username and password
  $rs = mysqli_query($link, $loginQuery);

  // Fetch the results and place into an object
  while($obj = mysqli_fetch_object($rs)) {
    $arr[] = $obj;
  }
  // Encode the results into a json type object
  $results = json_encode($arr);

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
