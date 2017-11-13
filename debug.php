<?php
// Function to output data for debugging
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

// Function to output data for debugging
function placeString($output, $startPosition) {
    echo "<br>";
    for ($i = 0; $i < 10; $i++) {
        echo $output[$startPosition + $i];
    }
    echo "</br>";
}

?>
