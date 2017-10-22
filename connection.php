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
  return $results;
  }
?>
