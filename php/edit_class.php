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
  $stmt = $conn->prepare("UPDATE Class SET name=(?), description=(?), enroll_open=(?), topic_id=(?) WHERE class_id=(?)");
  $stmt->bind_param("ssbii", $name, $description, $enroll_open, $topic, $class_id);

  $class_idErr = $nameErr = $descriptionErr = $enroll_openErr = $tutor_unameErr = $topicErr = "";
  $error = false;

  if (empty($_POST["class_id"])) {
    $error = true;
    $class_idErr = "Class selection is required. ";
  } else {
    $class_id = test_input($_POST["class_id"]);
    if (!isa_number($class_id)) {
      $error = true;
      $class_idErr = "Class ID must be a number. ";
    }
  }

  if (empty($_POST["name"])) {
    $error = true;
    $nameErr = "Class name is required. ";
  } else {
    $name = test_input($_POST["name"]);
    if (!isa_classname($name)) {
      $error = true;
      $nameErr = "Class name must be max 64 characters. Please enter a valid class name. ";
    }
  }

  if (empty($_POST["description"])) {
    $descriptionErr = "";
  } else {
    $description = test_input($_POST["description"]);
    if (!isa_comment($description)) {
      $error = true;
      $descriptionErr = "Description must be max 500 characters. Please enter a valid description. ";
    }
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
      //$enroll_open = TRUE;
      $error = true;
      $enroll_openErr = "Enrollment setting is required. ";
    }

  }

  if (empty($_POST["topic"])) {
    $error = true;
    $topicErr = "Topic is required. ";
  } else {
    $topic = test_input($_POST["topic"]);
    // check if topic ID 
    if (!isa_number($topic)) {
      $error = true;
      $topicErr = "Topic ID is not valid. "; 
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
