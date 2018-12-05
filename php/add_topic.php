<?php

require "./conndb.php";
require "./testdata.php";

// Check connection
if (mysqli_connect_errno($conn))
  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  // prepare and bind
  $stmt = $conn->prepare("INSERT INTO Topic(name, description) VALUES (?, ?)");
  $stmt->bind_param("ss", $name, $description);

  $name_er = $description_er = "";

  if (empty($_POST["name"])) {
    $name_er = "Topic name is required.";
  } else {
    $name  = test_input($_POST["name"]);
  }

  if (empty($_POST["description"])) {
    $description_er = "Description is required.";
  } else {
    $description = test_input($_POST["description"]);
  }

  if ($stmt->execute() === TRUE) {
    echo '{"success": true, "err": "none"}';
  } else {
    echo '{"success": false, "err": ' . $name_er . $description_er .'}';
  }

  include "disconndb.php";
?>
