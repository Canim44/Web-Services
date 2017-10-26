<?php

// This function will parse the data provided by Google Finance's stock JSON
function parseStock($output)
{
    // Initializing the variables to hold the index of the parse and
    // the position of the end quote of each token and field
    $parsePosition = 0;
    $endQuote = 0;

    // Placing the relevant data into variables
    $symbol = getField($output, $parsePosition, $endQutoe, "symbol");
    $exchange = getField($output, $parsePosition, $endQutoe, "exchange");
    $name = getField($output, $parsePosition, $endQutoe, "name");
    $change = getField($output, $parsePosition, $endQuote, "c");
    $price = getField($output, $parsePosition, $endQuote, "l");
    $changePercent = getField($output, $parsePosition, $endQuote, "cp");
    $openPrice = getField($output, $parsePosition, $endQuote, "op");
    $high = getField($output, $parsePosition, $endQuote, "hi");
    $low = getField($output, $parsePosition, $endQuote, "lo");
}

// This function will parse the data provided by the Google Finance's option json
function parseOption($outoput) {
  $parsePosition = 0;
  $endQuote = 0;


}

// This procedure takes the JSON input and parses it based on the tokens provided in the parseStock() and parseOption() functions
function getField($input, &$startQuote, &$endQuote, $token) {
  do {
    if ($startQuote == 0) {
      $startQuote = strpos($input, "\"");
    }
    else {
      $startQuote = strpos($input, "\"", $startQuote);
    }
    $startQuote++;
    $endQuote = strpos($input, "\"", $startQuote);
    $stringReturn = substr($input, $startQuote, $endQuote - $startQuote);
  } while ($stringReturn != $token);

  $startQuote = $endQuote + 1;

  $startQuote = strpos($input, "\"", $startQuote);
  $startQuote++;
  $endQuote = strpos($input, "\"", $startQuote);
  $stringReturn = substr($input, $startQuote, $endQuote - $startQuote);

  return $stringReturn;
}

?>
