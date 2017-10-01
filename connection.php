<?php
  function serverConnection() {
    // Variables for connection strings
    $servername = "localhost";
    $serveruser = "ukfl2017g2";
    $serverpass = "Ekwi32D98";

    // Initializing the link to the MySQL database
    $link = mysqli_connect($servername, $serveruser, $serverpass) or die("Error: Connection to Server failed");
    mysqli_select_db($link, "ukfl2017g2") or die("Error: Database");
    return $link;
  }

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

    $results = json_encode($arr);
    return $results;
  }

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
