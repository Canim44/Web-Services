<?php
  // This procedure initiates the connection with the database server and database itself.
  function serverConnection() {
    // Variables for connection strings
    $servername = "localhost";
    $serveruser = "ukfl2017g2";
    $serverpass = "Ekwi32D98";
    $database = "ukfl2017g2";

    // Initializing the link to the MySQL database
    $link = mysqli_connect($servername, $serveruser, $serverpass) or die("Error: Connection to Server failed");
    mysqli_select_db($link, $database) or die("Error: Database");
    return $link;
  }

?>
