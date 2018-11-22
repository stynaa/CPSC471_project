<?php

require "./conndb.php";
require "./testdata.php";

// Check connection
if (mysqli_connect_errno($conn))
  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  //@class_id, @name, @description, @enroll_open, @tutor_name, @topic

  // prepare and bind
  $stmt = $conn->prepare("INSERT INTO Class(name, description, enroll_open, tutor_name, topic) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("ssbsi", $name, $description, $enroll_open, $tutor_uname, $topic);

  $class_idErr = $nameErr = $descriptionErr = $enroll_openErr = $tutor_unameErr = $topicErr = "";

  if (empty($_POST["name"])) {
    $nameErr = "Class name is required";
  } else {
    $name = test_input($_POST["name"]);
  }

  if (empty($_POST["description"])) {
    $descriptionErr = "";
  } else {
    $description = test_input($_POST["description"]);
  }

  if (empty($_POST["enroll_open"])) {
    $enroll_openErr = "Enrollment setting is required";
  } else {
    if (empty($_POST["enroll_open"]) == 1) {
      $enroll_open = TRUE;
    } else if (empty($_POST["enroll_open"]) == 0) {
      $enroll_open = FALSE;
    } else {
      $enroll_openErr = "Enrollment setting is required";
    }

  }

  $tutor_uname = $_SESSION["username"];

  if (empty($_POST["topic"])) {
    $topicErr = "Topic is required";
  } else {
    $topic = test_input($_POST["topic"]);
    // check if topic ID 
    if (!preg_match("/^[0-9]*$/",$topic)) {
      $topicErr = "Topic ID not valid (backend issue)"; 
    }
  }

  if ($stmt->execute() === TRUE) {
    echo "{\"return\": \"SUCCESS\"}";
  } else {
    echo "e";
  }

  //$result = $stmt->get_result();
  //echo_json_encode_db($result);

  include "disconndb.php";
?>
