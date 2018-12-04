<!--DEPRECATED-->

<?php

require "./conn.php";
require "./testdata.php";

// Check connection
if (mysqli_connect_errno($con))
  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $username = $_SESSION["username"];
  $result = mysqli_query($con,"SELECT * FROM Schedule WHERE tutor_uname=".$username);

  if ($con->query($result) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $result . "<br>" . $con->error;
}

mysqli_close($con);
?>
