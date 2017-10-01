<?php
// Include the header file for JSON services and library
include_once("JSON.php");
// Initiating the JSON service
//$json = new Services_JSON();

// Initializing the link to the MySQL database
$link = mysqli_connect("localhost", "ukfl2017g2", "Ekwi32D98") or die("Could not connect");
mysql_select_db("ukfl2017g2") or die("Could not select database");
$arr = array();

$rs = mysqli_query($link, "SELECT * FROM users");
while($obj = mysqli_fetch_object($rs)) {
	$arr[] = $obj;
}
echo "here"; 
//Echo $json->encode($arr);
*/
?>
