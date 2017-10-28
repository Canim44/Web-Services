<?php
/*{"expiry":{"y":2017,"m":11,"d":17},"expirations":[{"y":2017,"m":11,"d":17},{"y":2018,"m":1,"d":19}],*/

// This function will parse the data provided by the Google Finance's option json
function parseOption($output) {
  $parsePosition = 0;
  $endPosition = 0;

  getExpiry($output, $parsePosition, $endPosition);
  echo $parsePosition;
  //$symbol = getField($output, $parsePosition, $endQutoe, "symbol");
  if (strpos($output, "expirations", $parsePosition) != NULL) {
      //do {
          getExpiry($output, $parsePosition, $endPosition);
          getExpiry($output, $parsePosition, $endPosition);
      //} while ();
  }
}
function getExpiry($input, &$startPosition, &$endPosition) {
    // Block moves beyond the "expiry" or "expiration" label
    $startPosition = strpos($input, "\"");
    $startPosition++;
    $endPosition = strpos($input, "\"", $startPosition);

    // Each function call will get the year, month, and date in that order.
    $stringReturn = parseDate($input, $startPosition, $endPosition, ",");
//    echo $stringReturn;
    $stringReturn = parseDate($input, $startPosition, $endPosition, ",");
//    echo $stringReturn;
    $stringReturn = parseDate($input, $startPosition, $endPosition, "}");
//echo $startPosition;
//    echo $stringReturn;
}
// This function parses through the fields and the data for the date
function parseDate($input, &$startPosition, &$endPosition, $endChar) {
    // Block moves to get to the label
    $startPosition = $endPosition + 1;
    $startPosition = strpos($input, "\"", $startPosition);
    $startPosition++;
    $endPosition = strpos($input, "\"", $startPosition);

    //Block moves to get the value
    $startPosition = $endPosition + 1;
    $startPosition = strpos($input, ":", $startPosition);
    $startPosition++;
    $endPosition = strpos($input, $endChar, $startPosition);

    $stringReturn = substr($input, $startPosition, $endPosition - $startPosition);
    return $stringReturn;

}

// This function will parse the data provided by Google Finance's stock JSON
function parseStock($output) {
    // Initializing the variables to hold the index of the parse and
    // the position of the end quote of each token and field
    $parsePosition = 0;
    $endPosition = 0;

    // Placing the relevant data into variables
    $symbol = getField($output, $parsePosition, $endQutoe, "symbol");
    $exchange = getField($output, $parsePosition, $endQutoe, "exchange");
    $name = getField($output, $parsePosition, $endQutoe, "name");
    $change = getField($output, $parsePosition, $endPosition, "c");
    $price = getField($output, $parsePosition, $endPosition, "l");
    $changePercent = getField($output, $parsePosition, $endPosition, "cp");
    $openPrice = getField($output, $parsePosition, $endPosition, "op");
    $high = getField($output, $parsePosition, $endPosition, "hi");
    $low = getField($output, $parsePosition, $endPosition, "lo");
}

// This procedure takes the JSON input and parses it based on the tokens provided in the parseStock() and parseOption() functions
function getField($input, &$startPosition, &$endPosition, $token) {
    do {
        if ($startPosition == 0) {
            $startPosition = strpos($input, "\"");
        }
        else {
            $startPosition = strpos($input, "\"", $startPosition);
        }
        $startPosition++;
        $endPosition = strpos($input, "\"", $startPosition);
        $stringReturn = substr($input, $startPosition, $endPosition - $startPosition);
    } while ($stringReturn != $token);

    $startPosition = $endPosition + 1;

    $startPosition = strpos($input, "\"", $startPosition);
    $startPosition++;
    $endPosition = strpos($input, "\"", $startPosition);
    $stringReturn = substr($input, $startPosition, $endPosition - $startPosition);

    return $stringReturn;
}

?>
