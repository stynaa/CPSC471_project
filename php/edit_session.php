<?php

require "./conndb.php";
require "./testdata.php";

// Check connection
if (mysqli_connect_errno($conn))
  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  //need to also check tutor uname in sched item maybe...
  $stmt = $conn->prepare("SELECT COUNT(session_num) AS count FROM Session WHERE session_num=(?) AND class_id=(?)");
  $stmt->bind_param("ii", $session_num, $class_id);

  $session_num_er = $class_id_er = "";
  $error = false;

  if (empty($_POST["session_num"])) {
    $error = true;
    $session_num_er = "Session number is required.";
  } else {
    $session_num = test_input($_POST["session_num"]);
    if (!isa_number($session_num)) {
        $error = true;
        $session_num_er = "Session number value is invalid. ";
    }
  }

  if (empty($_POST["class_id"])) {
    $error = true;
    $class_id_er = "Class selection is required.";
  } else {
    $class_id = test_input($_POST["class_id"]);
    if(!isa_number($class_id)) {
        $error = true;
        $class_id_er = "Class ID value is invalid. ";
    }
  }

  $c1 = FALSE;
  if ($stmt->execute() === TRUE) {
      $c1 = TRUE;
      $result = $stmt->get_result();
    } else {
      echo '{"success": false, "err": "' . $session_num_er . $class_id_er . '"}';
    }

  while ($row = $result->fetch_assoc()) {
   //echo var_dump($row);
        //if there are no previously saved cases, insert into tables
        if ($row["count"]==0) {
            $stmt = $conn->prepare("INSERT INTO Schedule_item(start_time, end_time, tutor_uname, avail_flag, sessionitem_flag)
            VALUES (?, ?, ?, ?, TRUE)");
            $stmt->bind_param("sssb", $start_time, $end_time, $tutor_uname, $avail_flag);

            $start_time_er = $end_time_er = $tutor_uname_er = $avail_flag_er = "";

            if (empty($_POST["start_time"])) {
                $error = true;
                $start_time_er = "Start time is required.";
            } else {
                $start_time = test_input($_POST["start_time"]);
                $start_time_er = isa_starttime($start_time);
                if (!empty($start_time_er)) {
                    $error = true;
                }
            }

            if (empty($_POST["end_time"])) {
                $error = true;
                $end_time_er = "End time is required. ";
            } else {
                $end_time = test_input($_POST["end_time"]);
                $end_time_er = isa_endtime($end_time, $start_time);
                if (!empty($end_time_er)) {
                    $error = true;
                }
            }

            if (empty($_POST["avail_flag"])) {
                $error = true;
                $avail_flag_er = "Availibility selection is required. ";
            } else {
                if (empty($_POST["avail_flag"]) == 1) {
                    $avail_flag = TRUE;
                } else if (empty($_POST["avail_flag"]) == 0) {
                    $avail_flag = FALSE;
                } else {
                    $error = true;
                    $avail_flag_Er = "Availibility selection is invalid. ";
                }
            }

            $tutor_uname = $_SESSION["username"];
            $c2 = FALSE;

            if (!$error) {
                if ($stmt->execute() === TRUE) {
                    $result_id=$stmt->insert_id;
                    $c2 = TRUE;
                } else {
                    echo '{"success": false, "err": "Insert-1: ' . $start_time_er . $end_time_er . $tutor_uname_er . $avail_flag_er .'"}';
                }
            } else {
                echo '{"success": false, "err": "' . $start_time_er . $end_time_er . $tutor_uname_er . $avail_flag_er .'"}';
            }
            

            $stmt = $conn->prepare("INSERT INTO Session(class_id, session_num, summary, location_id, sched_item_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iisii", $class_id, $session_num, $summary, $location_id, $sched_item_id);

            $summary_er = $location_id_er = $sched_item_id_er = "";

            $sched_item_id = $result_id;

            if (empty($_POST["summary"])) {
                $summary = "";
            } else {
                $summary = test_input($_POST["summary"]);
                if (!isa_comment($summary)) {
                    $error = true;
                    $summary_er = "Summary must be max 500 characters. Please enter valid summary. ";
                }
            }

            if (empty($_POST["location_id"])) {
                $error = true;
                $location_id_er = "Location selection is required. ";
            } else {
                 $location_id = test_input($_POST["location_id"]);
                 if (!isa_number($location_id)) {
                     $error = true;
                     $location_id_er = "Location ID value is invalid. ";
                 }
            }

            $c3 = FALSE;

            if (!$error) {
                if ($stmt->execute() === TRUE) {
                    $c3 = TRUE;
                } else {
                    echo '{"success": false, "err": "insert-2: ' . $sched_item_id . $class_id . $session_num . $summary . $location_id .'"}';
                }
            } else {
                echo '{"success": false, "err": "' . $sched_item_id . $class_id . $session_num . $summary . $location_id .'"}';
            }
            

        } 
        //if there are previously saved session with same combined key, update session
        else {
            //update Session table
            $stmt = $conn->prepare("UPDATE Session SET summary=(?), location_id=(?) WHERE class_id=(?) AND session_num=(?)");
            $stmt->bind_param("siii", $summary, $location_id, $class_id, $session_num);

            $summary_er = $location_id_er = "";

            if (empty($_POST["summary"])) {
                $summary = "";
            } else {
                $summary = test_input($_POST["summary"]);
                if (!isa_comment($summary)) {
                    $error = true;
                    $summary_er = "Summary must be max 500 characters. Please enter valid summary. ";
                }
            }
    
            if (empty($_POST["location_id"])) {
                $error = true;
                $location_id_er = "Location selection is required. ";
            } else {
                 $location_id = test_input($_POST["location_id"]);
                 if (!isa_number($location_id)) {
                     $error = true;
                     $location_id_er = "Location ID value is invalid. ";
                 }
            }

            $c4 = FALSE;

            if (!$error) {
                if ($stmt->execute() === TRUE) {
                    $c4 = TRUE;
                } else {
                    echo '{"success": false, "err": "update-1: ' . $class_id_er . $session_num_er . $summary_er . $location_id_er .'"}';
                }
            } else {
                echo '{"success": false, "err": "' . $class_id_er . $session_num_er . $summary_er . $location_id_er .'"}';
            }
            

            $stmt = $conn->prepare("SELECT sched_item_id FROM Session WHERE class_id=(?) AND session_num=(?)");
            $stmt->bind_param("ii", $class_id, $session_num);

            $c5 = FALSE;
            
            if (!$error) {
                if ($stmt->execute() === TRUE) {
                    //may need to check value of sched_item_id in var_dump matches
                    $c5 = TRUE;
                    //echo var_dump($stmt);
                    $result = $stmt->get_result();
                    
                } else {
                    echo '{"success": false, "err": "update-2: could not get sched_item_id with ' . $class_id . ' ' . $session_num .'"}';
                }
            } else {
                echo '{"success": false, "err": "Could not get sched_item_id with ' . $class_id . ' ' . $session_num .'"}';
            }
            

            while ($row = $result->fetch_assoc()) {
                $result_id = $row["sched_item_id"];
                //echo var_dump($result_id);
            }
            $stmt = $conn->prepare("UPDATE Schedule_item SET start_time=(?), end_time=(?), tutor_uname=(?), avail_flag=(?) WHERE schitem_id=(?)");
            $stmt->bind_param("sssbi", $start_time, $end_time, $tutor_uname, $avail_flag, $sched_item_id);

            $start_time_er = $end_time_er = $tutor_uname_er = $avail_flag_er = "";

            $sched_item_id = $result_id;
            
            $tutor_uname = $_SESSION["username"];

            if (empty($_POST["start_time"])) {
                $error = true;
                $start_time_er = "Start time is required.";
            } else {
                $start_time = test_input($_POST["start_time"]);
                $start_time_er = isa_starttime($start_time);
                if (!empty($start_time_er)) {
                    $error = true;
                }
            }

            if (empty($_POST["end_time"])) {
                $error = true;
                $end_time_er = "End time is required. ";
            } else {
                $end_time = test_input($_POST["end_time"]);
                $end_time_er = isa_endtime($end_time, $start_time);
                if (!empty($end_time_er)) {
                    $error = true;
                }
            }

            if (empty($_POST["avail_flag"])) {
                $error = true;
                $avail_flag_er = "Availibility selection is required. ";
            } else {
                if (empty($_POST["avail_flag"]) == 1) {
                    $avail_flag = TRUE;
                } else if (empty($_POST["avail_flag"]) == 0) {
                    $avail_flag = FALSE;
                } else {
                    $error = true;
                    $avail_flag_Er = "Availibility selection is invalid. ";
                }
            }

            $c6 = FALSE;

            if (!$error) {
                if ($stmt->execute() === TRUE) {
                    $c6 = TRUE;
                } else {
                echo '{"success": false, "err": "update-3: ' . $start_time_er . $end_time_er . $tutor_uname_er . $avail_flag_er .'"}';
                }
            } else {
                echo '{"success": false, "err": "' . $start_time_er . $end_time_er . $tutor_uname_er . $avail_flag_er .'"}';
            }
    
      }
  }
  
  //$result = $stmt->get_result();
  //echo_json_encode_db($result);

  if (($c1 && $c2 && $c3) || ($c1 && $c4 && $c5 && $c6)) {
    echo '{"success": true, "err": "none"}';
  }
  include "disconndb.php";
?>
