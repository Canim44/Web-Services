<?php
  // Include the functions provided in "connection.php"
  require_once("connection.php");

  // Get parameters passed into the script
  $username = $_GET["user"];
  $password = $_GET["pass"];
  $email = $_GET["email"];

  $link = serverConnection();

 // escapeAt($email);

  // Query to check if anything is returned when trying to match by username
  $query = "SELECT COUNT(*) FROM users WHERE username = \"" . $username . "\"";
  // Run query
  $result = runQuery($link, $query);

  $compareOutput = "[{\"COUNT(*)\":\"0\"}]";//$result;
  if (strcmp($result, $compareOutput) == 0) {
    $registerQuery = "INSERT INTO users (username, password, email) VALUES ('". $username . "', '" . $password . "', '" . $email . "')";
    $result = runNoReturnQuery($link, $registerQuery);
    //echo $registerQuery;
  }
  else {
      echo "User exists";
  }

  function escapeAt(&$email) {
      $position = strpos($email, "");

      $email = substr($email, 0, $position) . "\\" . substr($email, $position);
  }
?>
