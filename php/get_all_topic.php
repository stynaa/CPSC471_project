<?php

require "./conndb.php";
require "./testdata.php";

// Check connection
if (mysqli_connect_errno($conn))
  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  // prepare and bind
  $stmt = "SELECT name FROM Topic;";

  $result = $conn->query($stmt);
  if ($result->num_rows > 0) {
    //edit this
    echo_json_encode_db($result);
  } else {
    echo "e";
  }

  //$result = $stmt->get_result();
  //echo_json_encode_db($result);

  include "disconndb.php";
?>
