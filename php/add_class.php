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
  $stmt = $conn->prepare("INSERT INTO Class(name, description, enroll_open, tutor_uname, topic_id) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("ssbsi", $name, $description, $enroll_open, $tutor_uname, $topic);

  $class_idErr = $nameErr = $descriptionErr = $enroll_openErr = $tutor_unameErr = $topicErr = "";
  $error = false;

  if (empty($_POST["name"])) {
    $error = true;
    $nameErr = "Class name is required. ";
  } else {
    $name = test_input($_POST["name"]);
    if (!isa_classname($name)) {
      $error = true;
      $nameErr = "Class name is too long. Please enter valid class name. ";
    } 
  }

  if (empty($_POST["description"])) {
    $descriptionErr = "";
  } else {
    $description = test_input($_POST["description"]);
  }

  if (empty($_POST["enroll_open"])) {
    $error = true;
    $enroll_openErr = "Enrollment setting is required. ";
  } else {
    if ($_POST["enroll_open"] == 'yes') {
      $enroll_open = TRUE;
    } else if ($_POST["enroll_open"] == 'no') {
      $enroll_open = FALSE;
    } else {
      $error = true;
      $enroll_openErr = "Enrollment setting is required. ";
    }
  }

  $tutor_uname = $_SESSION["username"];

  if (empty($_POST["topic"])) {
    $error = true;
    $topicErr = "Topic is required. ";
  } else {
    $topic = test_input($_POST["topic"]);
    // check if topic ID 
    if (!isa_number($topic)) {
      $error = true;
      $topicErr = "Topic ID not valid (backend issue). "; 
    }
  }

  if (!$error) {
    if ($stmt->execute() === TRUE) {
      echo '{"success": true, "err": "none"}';
    } else {
      echo '{"success": false, "err": "' . $class_idErr . $nameErr . $descriptionErr . $enroll_openErr . $tutor_unameErr . $topicErr .'"}';
    }
  } else {
    echo '{"success": false, "err": "' . $class_idErr . $nameErr . $descriptionErr . $enroll_openErr . $tutor_unameErr . $topicErr .'"}';
  }
  

  //$result = $stmt->get_result();
  //echo_json_encode_db($result);

  include "disconndb.php";
?>
