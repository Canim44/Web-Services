<?php
/*
{"expiry":{"y":2017,"m":11,"d":17},"expirations":[{"y":2017,"m":11,"d":17},{"y":2018,"m":1,"d":19}],
"puts":[{"cid":"427952368358533","name":"","s":"AAPL171117P00050000","e":"OPRA","p":"0.02","cs":"chb","c":"0.00","cp":"0.00","b":"-","a":"0.02","oi":"627","vol":"-","strike":"50.00","expiry":"Nov 17, 2017"}*/
// This function will parse the data provided by the Google Finance's option json
function parseOption($output) {
  $parsePosition = 0;
  $endQuote = 0;

  getExpiry($output, $parsePosition, $endQuote);


  //$symbol = getField($output, $parsePosition, $endQutoe, "symbol");

}
function getExpiry($input, $startQuote, $endQuote) {
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
  } while ($stringReturn != "expiry");

  $startQuote = $endQuote + 1;

  $startQuote = strpos($input, "\"", $startQuote);
  $startQuote++;
  $endQuote = strpos($input, "\"", $startQuote);
  $stringReturn = substr($input, $startQuote, $endQuote - $startQuote);

  $startQuote = $endQuote + 1;
  $startQuote++;
  $endQuote = strpos($input, ",", $startQuote);
  $stringReturn = substr($input, $startQuote, $endQuote - $startQuote);
  echo $stringReturn;
}
function formatDate(&$expiration, $index) {
}

// This function will parse the data provided by Google Finance's stock JSON
function parseStock($output) {
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
