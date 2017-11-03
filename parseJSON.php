<?php
include_once("connection.php");
include_once("debug.php");

// This function will parse the data provided by the Google Finance's option json
function parseOption($output) {
    // Initializing the parse counters
    $startPosition = 0;
    $endPosition = 0;
    $nextSection = 0;

    // Get the expiration date
    getExpiry($output, $startPosition, $endPosition, 1);

    // If multiple expiration dates exist, run this block
    if (strpos($output, "expirations", $startPosition != NULL)) {
        // Advance the start position of the search to "expirations"
        $startPosition = strpos($output, "\"expirations", $startPosition);

        // Initializing $tempInt with a dummy variable
        $tempInt = 10;

        // Run this loop while the end square bracket's location from the
        // start position is greater than 1, which is where it would be located
        // if the square bracket were to appear.
        do {
             getExpiry($output, $startPosition, $endPosition, 2);
             $tempInt = strpos($output, "]", $endPosition) - $endPosition;
        } while ($tempInt >= 2);
    }

    $startPosition = strpos($output, "\"puts\"", $startPosition);
echo $startPosition;
    $startPosition = strpos($output, "\"calls\"", $startPosition);
echo $startPosition;
}

function getExpiry($input, &$startPosition, &$endPosition, $firstTime) {
    // Block moves beyond the "expiry" or "expiration" label
    if ($firstTime == 1) {
        $startPosition = strpos($input, "\"");
    }
    else {
        if ($startPosition >= strpos($input, "expirations")) {
            $startPosition = $startPosition - 4;
            $startPosition = strpos($input, "\"", $startPosition);
        }
        printStuff($startPosition, 1);
    }
    $startPosition++;
    $endPosition = strpos($input, "\"", $startPosition);

    $tempyear = parseDate($input, $startPosition, $endPosition, ",");
    $tempmonth = parseDate($input, $startPosition, $endPosition, ",");
    $tempdate = parseDate($input, $startPosition, $endPosition, "}");

}
/* ----------------------------------------------------------------------------------------
    Due to the JSON file returned by Google Finance, a traditional JSON parse cannot be used.
    These procedures will parse the data in a specific manner.
   ---------------------------------------------------------------------------------------- */
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
    // Initializing array to hold all the data
    $stocks= array("", "", "", "", "", "", "", "", "");
    $startPosition = 0;
    // Meaning of each index
    // 0 = SYMBOL
    // 1 = EXCHANGE
    // 2 = STOCK ID
    // 3 = COMPANY NAME
    // 4 = CHANGE IN PRICE
    // 5 = PRICE
    // 6 = CHANGE PERCENT
    // 7 = OPENING PRICE
    // 8 = INTRADAY HIGH
    // 9 = INTRADAY LOW
    // Placing the relevant data into variables
    $stocks[0] = parseField($output, "\"symbol\"", $startPosition);
    $stocks[1] = parseField($output, "\"exchange\"", $startPosition);
    $stocks[2] = parseField($output, "\"id\"", $startPosition);
    $stocks[3] = parseField($output, "\"name\"", $startPosition);
    $stocks[4] = parseField($output, "\"c\"", $startPosition);
    $stocks[5] = parseField($output, "\"l\"", $startPosition);
    $stocks[6] = parseField($output, "\"cp\"", $startPosition);
    $stocks[7] = parseField($output, "\"op\"", $startPosition);
    $stocks[8] = parseField($output, "\"hi\"", $startPosition);
    $stocks[9] = parseField($output, "\"lo\"", $startPosition);

    return $stocks;
}
