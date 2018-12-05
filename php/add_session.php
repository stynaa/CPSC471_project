<?php

require "./conndb.php";
require "./testdata.php";

// Check connection
if (mysqli_connect_errno($conn))
  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  


  // prepare and bind
  $stmt = $conn->prepare("INSERT INTO Schedule_item(start_time, end_time, tutor_uname, avail_flag, sessionitem_flag)
         VALUES (?, ?, ?, ?, TRUE)");
  $stmt->bind_param("sssb", $start_time, $end_time, $tutor_uname, $avail_flag);

  $start_time_er = $end_time_er = $tutor_uname_er = $avail_flag_er = "";

  if (empty($_POST["start_time"])) {
    $start_time_er = "Start time is required.";
  } else {
    $start_time = test_input($_POST["start_time"]);
  }

  if (empty($_POST["end_time"])) {
    $end_time_er = "End time is required.";
  } else {
    $end_time = test_input($_POST["end_time"]);
  }

  if (empty($_POST["avail_flag"])) {
    $avail_flag_er = "Availibility selection is required";
  } else {
    if (empty($_POST["avail_flag"]) == 1) {
      $avail_flag = TRUE;
    } else if (empty($_POST["avail_flag"]) == 0) {
      $avail_flag = FALSE;
    } else {
      $avail_flag_Er = "Availibility selection is required";
    }
  }

  $tutor_uname = $_SESSION["username"];
  $s1 = FALSE;
  if ($stmt->execute() === TRUE) {
    
    $result_id=$stmt->insert_id;
    $s1 = TRUE;
  } else {
    echo '{"success": false, "err": 1' . $start_time_er . $end_time_er . $date_er . $tutor_uname_er . $avail_flag_er .'}';
  }

  $stmt = $conn->prepare("INSERT INTO Session(class_id, session_num, summary, location_id, sched_item_id) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("iisii", $class_id, $session_num, $summary, $location_id, $sched_item_id);
  
  $class_id_er = $session_num_er = $summary_er = $location_id_er = $scheditem_id_er = "";

  $sched_item_id = $result_id;

  if (empty($_POST["class_id"])) {
    $class_id_er = "Class selection is required.";
  } else {
    $class_id = test_input($_POST["class_id"]);
  }

  if (empty($_POST["session_num"])) {
    $session_num_er = "Session number is required.";
  } else {
    $session_num = test_input($_POST["session_num"]);
  }

  if (empty($_POST["summary"])) {
    $summary = "";
  } else {
    $summary = test_input($_POST["summary"]);
  }

  if (empty($_POST["location_id"])) {
    $location_id_er = "Location selection is required.";
  } else {
    $location_id = test_input($_POST["location_id"]);
  }

  $s2 = FALSE;
  if ($stmt->execute() === TRUE) {
    $s2 = TRUE;
  } else {
    echo '{"success": false, "err": 2' . $class_id_er . $session_num_er . $summary_er . $location_id_er . $scheditem_id_er .'}';
  }
  //$result = $stmt->get_result();
  //echo_json_encode_db($result);

  if ($s1 && $s2) {
    echo '{"success": true, "err": "none"}';
  }
  include "disconndb.php";
?>
