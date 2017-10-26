<?php
function parseStock($output)
{
    $parsePosition = 0;
    $endQuote = 0;

    $symbol = getField($output, $parsePosition, $endQutoe, "symbol");
    $exchange = getField($output, $parsePosition, $endQutoe, "exchange");
    $name = getField($output, $parsePosition, $endQutoe, "name");
    $change = getField($output, $parsePosition, $endQuote, "c");
    $price = getField($output, $parsePosition, $endQuote, "l");

    // do {
    //   $symbol = getField($output, $parsePosition, $endQuote);
    //   $parsePosition = $endQuote + 1;
    // } while ($symbol != "symbol");
    // $symbol = getField($output, $parsePosition, $endQuote);
    //
    // do {
    //   $exchange = getField($output, $parsePosition, $endQuote);
    //   $parsePosition = $endQuote + 1;
    // } while ($exchange != "exchange");
    // $exchange = getField($output, $parsePosition, $endQuote);
    //
    // do {
    //   $name = getField($output, $parsePosition, $endQuote);
    //   $parsePosition = $endQuote + 1;
    // } while ($name != "name");
    // $name = getField($output, $parsePosition, $endQuote);
    //
    // do {
    //   $change = getFiel($output, $parsePosition, $endQuote);
    //   $parsePosition = $endQuote + 1;
    // } while ($change != "c");
    // $change = getField($output, $parsePosition, $endQuote);

    echo $symbol;
    echo $exchange;
    echo $name;
    echo $change;
    echo $price;
}

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

  // if ($startQuote == 0) {
  //   $startQuote = strpos($input, "\"");
  // }
  // else {
  //   $startQuote = strpos($input, "\"", $startQuote);
  // }
  // $startQuote++;
  // $endQuote = strpos($input, "\"", $startQuote);
  // $stringReturn = substr($input, $startQuote, $endQuote - $startQuote);

  return $stringReturn;
}

function copyToVariabel($input, $variable, $index, $endIndex) {
  $variable = substr($output, $index, $sendIndex + $index);
  return $variable;
}
?>
