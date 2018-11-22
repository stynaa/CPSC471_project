<?php
    $servername = "104.157.39.239"; //104.157.39.239
    $username = "cpsc471";
    $password = "pw";
    $database = "tutorDB";
    $port = 19239;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Database connection failed, please retry." . $conn->connect_error);
    }

    /* Global functions */
    function echo_json_encode_db(&$queryResult) {
        echo "{\"result\":{";
        $ctr = 0;
        while ($row = $queryResult->fetch_assoc()) {
            if ($ctr != 0) {
                echo ",";
            }
            echo "\"" . $ctr . "\":" .json_encode($row);
            $ctr++;
        }
        echo "},\"numRows\":" . $ctr . "}";
    }

?>
