<?php
function printStuff($variable, $variableName) {
    echo "<br>" . $variableName . " - " . $variable . "</br>";
}

// This function will parse the data provided by the Google Finance's option json
function parseOption($output) {
    $startPosition = 0;
    $endPosition = 0;
    $nextSection = 0;
    getExpiry($output, $startPosition, $endPosition, 1);
    //$symbol = getField($output, $parsePosition, $endQutoe, "symbol");
    if (strpos($output, "expirations", $startPosition) != NULL) {
        //do {
        $startPosition = strpos($output, "expirations");
        $nextSection = strpos($output, "puts");
for ($i = 0; $i < 12; $i++) {
}
        getExpiry($output, $startPosition, $endPosition, 2);
        //echo $startPosition;
        //getExpiry($output, $startPosition, $endPosition, 2);
        //} while ($startPosition <= $nextSection);
    }
}

function getExpiry($input, &$startPosition, &$endPosition, $firstTime) {
    // Block moves beyond the "expiry" or "expiration" label
    if ($firstTime == 1) {
        $startPosition = strpos($input, "\"");
    }
    else {

        $startPosition = strpos($input, "\"", $startPosition);
//        printStuff($startPosition, "Start Position");
    }

    $startPosition++;
    printStuff($startPosition, "Start Position");
    $endPosition = strpos($input, "\"", $startPosition);
//    printStuff($endPosition, "End Position");
    $tempyear = parseDate($input, $startPosition, $endPosition, ",");
    $tempmonth = parseDate($input, $startPosition, $endPosition, ",");
    $tempdate = parseDate($input, $startPosition, $endPosition, "}");
if ($firstTime == 2) {
    printStuff($tempyear, "Temp Year");
    printStuff($tempmonth, "Temp Month");
    printStuff($tempdate, "Temp Date");
}
//     // Each function call will get the year, month, and date in that order.
//     $stringReturn parseDate($input, $startPosition, $endPosition, ",");
// echo $stringReturn;
//     $stringReturn = parseDate($input, $startPosition, $endPosition, ",");
// echo $stringReturn;
//     $stringReturn = parseDate($input, $startPosition, $endPosition, "}");
// echo $stringReturn;
}
// This function parses through the fields and the data for the date
function parseDate($input, &$startPosition, &$endPosition, $endChar) {
    // Block moves to get to the label
    $startPosition = $endPosition + 1;
    $startPosition = strpos($input, "\"", $startPosition);
    $startPosition++;
    $endPosition = strpos($input, "\"", $startPosition);
for ($i = 0; $i < 10; $i++) {
    echo $input[$startPosition + $i];
}
    //Block moves to get the value
    $startPosition = $endPosition + 1;
    $startPosition = strpos($input, ":", $startPosition);
    printStuff($startPosition, "Start Position in Parse Date");
    $startPosition++;
    $endPosition = strpos($input, $endChar, $startPosition);

    $stringReturn = substr($input, $startPosition, $endPosition - $startPosition);
    //$startPosition = $endPosition + 1;
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
