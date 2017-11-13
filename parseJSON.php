<?php
include_once("connection.php");
include_once("debug.php");

// This function will parse the data provided by the Google Finance's option json
function parseOption($output, $stockArray) {
    // Initializing the parse counters
    $startPosition = 0;
    $endPosition = 0;
    $nextSection = 0;

    $expirations = array();
    // Get the expiration date
    array_push($expirations, getExpiry($output, $startPosition, $endPosition, 1));
    $stockName = $stockArray[3];
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
             array_push($expirations, getExpiry($output, $startPosition, $endPosition, 2));
             $tempInt = strpos($output, "]", $endPosition) - $endPosition;
        } while ($tempInt >= 2);
    }

    // Remove the first element, which is duplicated
    $temp = array_shift($expirations);

    // Create an array that will hold all the puts data
    $putsArray = array();
    // Move the start position to the first instance of "puts"
    $startPosition = strpos($output, "\"puts\"", $startPosition);

    // Save the start position of "calls" to compare against where the $startPosition is currently located
    $callsPosition = strpos($output, "\"calls\"", $startPosition);

    while ($callsPosition > strpos($output, "\"cid\"", $startPosition)) {
    //Parsing the data from the JSON file
    $startPosition = getOptionData($output, $startPosition, $putsArray);
    }
}

function getOptionData($input, $startPosition, &$putsArray) {
    $startPosition = strpos($input, "\"cid\"", $startPosition);
    $cid = parseField($input, "\"cid\"", $startPosition);
    $price = parseField($input, "\"p\"", $startPosition);
    $change = parseField($input, "\"c\"", $startPosition);
    $changePercent = parseField($input, "\"cp\"", $startPosition);
    $bid = parseField($input, "\"b\"", $startPosition);
    if ($bid == "-") {
        $bid = 0;
    }

    $ask = parseField ($input, "\"a\"", $startPosition);
    $fill = round(($bid + $ask) / 2, 2);
    $startPosition = strpos($input, "\"strike\"", $startPosition);
    $strike = parseField($input, "\"strike\"", $startPosition);

    $parsed = $cid . "|" . $price . "|" . $change . "|" . $changePercent . "|" . $fill . "|" . $strike;
    echo $parsed. "<br>";
    array_push($putsArray, $parsed);
    return $startPosition;
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
    }
    $startPosition++;
    $endPosition = strpos($input, "\"", $startPosition);

    $tempyear = parseDate($input, $startPosition, $endPosition, ",");
    $tempmonth = parseDate($input, $startPosition, $endPosition, ",");
    $tempdate = parseDate($input, $startPosition, $endPosition, "}");

    $expiryDate = "expd=" . $tempdate . "expm=" . $tempmonth. "expy=" . $tempyear;
    return $expiryDate;
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
