<?php
/*{"expiry":{"y":2017,"m":11,"d":17},"expirations":[{"y":2017,"m":11,"d":17},{"y":2018,"m":1,"d":19}],*/

// This function will parse the data provided by the Google Finance's option json
function parseOption($output) {
  $parsePosition = 0;
  $endQuote = 0;

  getExpiry($output, $parsePosition, $endQuote);
  //$symbol = getField($output, $parsePosition, $endQutoe, "symbol");

}
function getExpiry($input, $startQuote, $endQuote) {
    // Block moves beyond the "expiry" label
    $startQuote = strpos($input, "\"");
    $startQuote++;
    $endQuote = strpos($input, "\"", $startQuote);

    $stringReturn = parseDate($input, $startQuote, $endQuote, ",");
    echo $stringReturn;
    $stringReturn = parseDate($input, $startQuote, $endQuote, ",");
    echo $stringReturn;
    $stringReturn = parseDate($input, $startQuote, $endQuote, "}");

    echo $stringReturn;
}
// This function parses through the fields and the data for the date
function parseDate($input, &$startQuote, &$endQuote, $endChar) {
    // Block moves to get to the label
    $startQuote = $endQuote + 1;
    $startQuote = strpos($input, "\"", $startQuote);
    $startQuote++;
    $endQuote = strpos($input, "\"", $startQuote);

    //Block moves to get the value
    $startQuote = $endQuote + 1;
    $startQuote = strpos($input, ":", $startQuote);
    $startQuote++;
    $endQuote = strpos($input, $endChar, $startQuote);

    $stringReturn = substr($input, $startQuote, $endQuote - $startQuote);
    return $stringReturn;

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
