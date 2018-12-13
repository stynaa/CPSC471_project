<?php

require "./conndb.php";
require "./testdata.php";

// Check connection
if (mysqli_connect_errno($conn))
  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  // prepare and bind
  $stmt = $conn->prepare("UPDATE Student SET dob=(?), first_name=(?), last_name=(?) WHERE student_id=(?)");
  $stmt->bind_param("ssss", $dob, $first_name, $last_name, $student_id);

  $dob_er = $first_name_er = $last_name_er = $student_id_er = "";
  $error = false;
  $er = 0;

  if (empty($_POST["dob"])) {
    $error = true;
    $dob_er = "Date of birth is required. ";
  } else {
    $dob  = test_input($_POST["dob"]);
    $dob_er = isa_dob($dob);
    if (!empty($dob_er)) {
      $error = true;
    }
  }

  if (empty($_POST["first_name"])) {
    $error = true;
    $first_name_er = "First name is required. ";
  } else {
    $first_name = test_input($_POST["first_name"]);
    if (!isa_name($first_name)) {
      $error = true;
      $first_name_er = 'First name must be no more than 64 characters and only contain letters, spaces, dashes(-), and apostrophes(\'). Please enter a valid first name.';
    }
  }

  if (empty($_POST["last_name"])) {
    $error = true;
    $last_name_er = "Last name is required. ";
  } else {
    $last_name = test_input($_POST["last_name"]);
    if (!isa_name($last_name)) {
      $error = true;
      $last_name_er = 'Last name must be no more than 64 characters and only contain letters, spaces, dashes(-), and apostrophes(\'). Please enter a valid last name.';
    }
  }

  if (empty($_POST["student_id"])) {
    $error = true;
    $student_id_er = "Please select student. ";
  } else {
    $student_id = test_input($_POST["student_id"]);
    if (!isa_number($student_id)) {
      $error = true;
      $student_id_er = "Student ID is invalid. ";
    }
  }

  if (!$error) {
    if ($stmt->execute() === TRUE) {
      echo '{"success": true, "err": "none"}';
    } else {
      //echo var_dump($_POST);
      echo '{"success": false, "err": "' .   $dob_er . $first_name_er . $last_name_er . $student_id_er .'"}';
    }
  } else {
    echo '{"success": false, "err": "' . $dob_er . $first_name_er . $last_name_er . $student_id_er .'"}';
  }
  

  include "disconndb.php";
?>
