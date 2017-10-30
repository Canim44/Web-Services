<?php
function printStuff($variable, $option) {
    if ($option == 1) {
        $variableName = "Start Position";
    }
    else if ($option == 2) {
        $variableName = "End Position";
    }
    else if ($option == 3) {
        $variableName = "Temp Year";
    }
    else if ($option == 4) {
        $variableName = "Temp Month";
    }
    else if ($option == 5) {
        $variableName = "Temp Day";
    }

    echo "<br>" . $variableName . " - " . $variable . "</br>";
}

function placeString($output, $startPosition) {
    echo "<br>";
    for ($i = 0; $i < 10; $i++) {
        echo $output[$startPosition + $i];
    }
    echo "</br>";
}

// This function will parse the data provided by the Google Finance's option json
function parseOption($output) {
    // Initializing the parse counters
    $startPosition = 0;
    $endPosition = 0;
    $nextSection = 0;

    getExpiry($output, $startPosition, $endPosition, 1);

    if (strpos($output, "expirations", $startPosition != NULL)) {
        $startPosition = strpos($output, "\"expirations", $startPosition);
        $tempInt = 10;
        do {
             getExpiry($output, $startPosition, $endPosition, 2);
             $tempInt = strpos($output, "]", $endPosition) - $endPosition;
        } while ($tempInt >= 2);
    }
    if (strpos($output, "\"calls\"") > strpos($output, "\"puts\"")) {
        $startposition = strpos($output, "\"calls");

    }
    else {
        $startposition = strpos($output, "\"puts");
    }

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

    // Initializing array to hold all the data
    $stocks= array("", "", "", "", "", "", "", "", "");
    // Meaning of each index
    // 0 = SYMBOL
    // 1 = EXCHANGE
    // 2 = COMPANY NAME
    // 3 = CHANGE IN PRICE
    // 4 = PRICE
    // 5 = CHANGE PERCENT
    // 6 = OPENING PRICE
    // 7 = INTRADAY HIGH
    // 8 = INTRADAY LOW
    // Placing the relevant data into variables
    $stocks[0] = getField($output, $parsePosition, $endPosition, "symbol");
    $stocks[1] = getField($output, $parsePosition, $endPosition, "exchange");
    $stocks[2] = getField($output, $parsePosition, $endPosition, "name");
    $stocks[3] = getField($output, $parsePosition, $endPosition, "c");
    $stocks[4] = getField($output, $parsePosition, $endPosition, "l");
    $stocks[5] = getField($output, $parsePosition, $endPosition, "cp");
    $stocks[6] = getField($output, $parsePosition, $endPosition, "op");
    $stocks[7] = getField($output, $parsePosition, $endPosition, "hi");
    $stocks[8] = getField($output, $parsePosition, $endPosition, "lo");

    return $stocks;
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
