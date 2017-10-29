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
    $startPosition = 0;
    $endPosition = 0;
    $nextSection = 0;

    getExpiry($output, $startPosition, $endPosition, 1);


    if (strpos($output, "expirations", $startPosition != NULL)) {
//        $startPosition = strpos($output, "\"expirations", $startPosition);
        //printStuff($startPosition, 1);
//        getExpiry($output, $startPosition, $endPosition, 2);
//        getExpiry($output, $startPosition, $endPosition, 2);
    }
//     if (strpos($output, "expirations", $startPosition) != NULL) {
//         $startPosition = strpos($output, "expirations");
//         $nextSection = strpos($output, "puts");
// printStuff($startPosition, "Start Position");
//         getExpiry($output, $startPosition, $endPosition, 2);
// printStuff($startPosition, "Start Position");
//         getExpiry($output, $startPosition, $endPosition, 2);
//     }
}

function getExpiry($input, &$startPosition, &$endPosition, $firstTime) {
    // Block moves beyond the "expiry" or "expiration" label
    if ($firstTime == 1) {
        $startPosition = strpos($input, "\"");
    }
    else {
        if ($startPosition <= strpos($input, "expirations")) {
            $startPosition = strpos($input, "\"", $startPosition);
        }
        else {
            $startPosition = strpos($input, "\"", $startPosition);
            $startPosition--;
            printStuff($startPosition, 1);
            printStuff($endPosition, 2);
        }
    }

    $startPosition++;
    $endPosition = strpos($input, "\"", $startPosition);

    $tempyear = parseDate($input, $startPosition, $endPosition, ",");
    $tempmonth = parseDate($input, $startPosition, $endPosition, ",");
    $tempdate = parseDate($input, $startPosition, $endPosition, "}");

//if ($firstTime == 2) {
    printStuff($tempyear, 3);
    printStuff($tempmonth, 4);
    printStuff($tempdate, 5);
//}

}
// This function parses through the fields and the data for the date
function parseDate($input, &$startPosition, &$endPosition, $endChar) {
    placeString($input, $startPosition);
    // Block moves to get to the label
    $startPosition = $endPosition + 1;
    $startPosition = strpos($input, "\"", $startPosition);
    $startPosition++;
    $endPosition = strpos($input, "\"", $startPosition);

echo "This is stuff";
placeString($input, $startPosition);
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
