<?php
// include_once("connection.php");
// include_once("calculations.php");
// include_once("googleRequest.php");
// include_once("login.php");
 include_once("parseJSON.php");
// include_once("portfolio.php");
// include_once("purchaseOption.php");
// include_once("purchaseStock.php");
// include_once("register.php");
// include_once("sellStock.php");

$myfile = fopen("json.txt", "r");
$output = "";

while (!feof($myfile)) {
    $line = fgets($myfile);
    $output = $output . $line;
}

fclose($myfile);
$myfile = fopen("f.txt", "r");
$stockArray = parseStock($output);
parseOption($output, $stockArray);

?>
