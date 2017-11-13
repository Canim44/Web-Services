<?php
  // Include the functions provided in "connection.php"
  require_once("connection.php");

  // Get parameters passed into the script
  $username = $_GET["user"];
  $password = $_GET["pass"];

  $link = serverConnection();

  // Query to check if anything is returned when trying to match by username
  $query = "SELECT COUNT(*) FROM users WHERE username = \"" . $username . "\"";
  // Run query
  $result = runQuery($link, $query);

  $compareOutput = "[{\"COUNT(*)\":\"0\"}]";//$result;
  if (strcmp($result, $compareOutput) == 0) {
    $registerQuery = "INSERT INTO users (username, password) VALUES ('". $username . "', '" . $password . "')";
    $result = runNoReturnQuery($link, $registerQuery);
  }
<<<<<<< HEAD
?>
=======
?>
>>>>>>> db596a7ef0a5a6df4cc80d02fe2e468422615306
