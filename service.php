<?php
// Include the header file for JSON services and library

include("JSON.php");
// Initiating the JSON service
//$json = new Services_JSON();

// Initializing the link to the MySQL database
$link = mysqli_connect("localhost", "ukfl2017g2", "Ekwi32D98") or die("Could not connect");
mysqli_select_db($link, "ukfl2017g2") or die("Could not select database");

$arr = array();

$rs = mysqli_query($link, "SELECT * FROM users");
while($obj = mysqli_fetch_object($rs)) {
	$arr[] = $obj;
}
//Echo $json->encode($arr);

?>
