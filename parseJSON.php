<?php
$symbol = "symbol";
$name = "name";
$price = 1.00;

function parseStock($output)
{
    $parsePosition = 0;
    for ($i = 0; $i < 4; $i++) {
      $parsePosition = skipQuotes($output, $parsePosition);
    }

    $endQuote = strpos($output, "\"", $parsePosition);
    $symbol = substr($output, $parsePosition, $endQuote + $parsePosition);
    echo $symbol;

    //$symbolPosition = strpos($output, "symbol\" : \"" );
    //echo strpos($output, " : ", $symbolPosition);
    //echo substr($output, 9, strpos($output," : ", $symbolPosition) - $symbolPosition - 1);
}

function skipQuotes($input, $index) {
  $index = strpos($input, "\"");
  return $index;
}

function copyToVariabel($input, $variable, $index, $endIndex) {
  $variable = substr($output, $index, $sendIndex + $index);
  return $variable;
}
?>
