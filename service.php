<?php

set_include_path("/Applications/XAMPP/xamppfiles/lib/php");
include_once("JSON.php");

$json = new Services_JSON();

$link = mysqli_connect("localhost", "root", "") or die("Could not connect");
mysqli_select_db($link, "test") or die("Could not select database");

$arr = array();

$rs = mysqli_query($link, "SELECT * FROM users");
while($obj = mysqli_fetch_object($rs)) {
	$arr[] = $obj;
}
 
Echo $json->encode($arr);

?>
