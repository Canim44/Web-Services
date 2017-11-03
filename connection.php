<?php
  // This procedure initiates the connection with the database server and database itself.
  function serverConnection() {
    // Variables for connection strings
    $servername = "localhost";
    $serveruser = "ukfl2017g2";
    $serverpass = "Ekwi32D98";
    $database = "ukfl2017g2";

    // Initializing the link to the MySQL database
    $link = mysqli_connect($servername, $serveruser, $serverpass) or die("Error: Connection to Server failed");
    mysqli_select_db($link, $database) or die("Error: Database");
    return $link;
    }

    // This procedure standardizes the way queries are run with the results formatted in json
    // $link and $query are set up in the caller function
    function runQuery(&$link, $query) {
        // Creating query object
        $rs = mysqli_query($link, $query);

        // Fetch the results and place into an object
        while($obj = mysqli_fetch_object($rs)) {
            $arr[] = $obj;
        }
        // Encode the results into a json type object
        $results = json_encode($arr);
        return $results;
    }

    // This procedure will parse the JSON output from the runQuery() function
    // $fieldName will need to be supplied in order to find the field immediately
    function parseField($result, $fieldName, $startPosition) {
        // Move the start position to the field
        $startPosition = strpos($result, $fieldName);
        $startPosition++;
        // Advance the start position beyond the last quote
        $startPosition = strpos($result, ":", $startPosition);

        // Advance the start position to the quotation surrounding the value for the field
        $startPosition = strPos($result, "\"", $startPosition);
        // Advance the end position to the next occurence of a quote at the end
        // of the field and then move it back one position to ignore the quote
        $endPosition = strpos($result, "\"", $startPosition + 1) - 1;

        // Copying the field into a return variable $fieldValue
        $fieldValue = substr($result, $startPosition + 1, $endPosition - $startPosition);
        return $fieldValue;
    }

    // This procedure standardizes the way queries are run with the results formatted in json
    // $link and $query are set up in the caller function
    function runBuySellQuery($query) {
        $link = serverConnection();

        if (mysqli_query($link, $query)) {
            return 1;
        }
        else {
            echo mysqli_error($link);
            return 0;
        }
    }

    function getUserID($user, $loginKey) {
        $link = serverConnection();
        $startPosition = 0;
        $getIDQuery = "SELECT id FROM users WHERE ";
        $userID = 0;

        if ($user != NULL) {
            $getIDQuery = $getIDQuery . " username = \"" . $user . "\"";
        }
        else {
            $getIDQuery = $getIDQuery . " loginkey = \"" . $loginKey . "\"";
        }

        $userID = runQuery($link, $getIDQuery);

        $userID = parseField($userID, "id", $startPosition);

        return $userID;
    }
?>
