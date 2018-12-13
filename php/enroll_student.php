<?php

require "./conndb.php";
require "./testdata.php";

// Check connection
if (mysqli_connect_errno($conn))
  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  //need to also check tutor uname in sched item maybe...
  $stmt = $conn->prepare("SELECT COUNT(student_id) AS count FROM Enrolled WHERE class_id=(?) AND student_id=(?)");
  $stmt->bind_param("ii", $class_id, $student_id);

  $student_id_er = $class_id_er = "";
  $error = false;

  if (empty($_POST["student_id"])) {
    $error = true;
    $student_id_er = "Student selection is required. ";
  } else {
    $student_id = test_input($_POST["student_id"]);
    if (!isa_number($student_id)) {
      $error = true;
      $student_id_er = "Student ID is invalid. ";
    }
  }

  if (empty($_POST["class_id"])) {
    $error = true;
    $class_id_er = "Class selection is required. ";
  } else {
    $class_id = test_input($_POST["class_id"]);
    if (!isa_number($class_id)) {
      $error = true;
      $class_id_er = "Class ID is invalid. ";
    }
  }

  $c1 = FALSE;
  if ($stmt->execute() === TRUE) {
      $c1 = TRUE;
      $result = $stmt->get_result();
    } else {
      $error = true;
      $q_er = "Unable to query database. ";
      //echo '{"success": false, "err": "Unable to query Enrolled: " ' . $student_id_er . $class_id_er . '}';
    }

  while ($row = $result->fetch_assoc()) {
   //echo var_dump($row);
        //if there are no previously saved cases, insert into tables
        if ($row["count"]==0) {
            $stmt = $conn->prepare("INSERT INTO Enrolled(class_id, student_id)
            VALUES (?, ?)");
            $stmt->bind_param("ii", $class_id1, $student_id1);

            $class_id1 = $class_id;
            $student_id1 = $student_id;

            if (!$error) {
              $c2 = FALSE;
              if ($stmt->execute() === TRUE) {
                  $c2 = TRUE;
              } else {
                  echo '{"success": false, "err": "Student not added: ' . $student_id_er . $class_id_er . $q_er . '"}';
              }
            } else {
              echo '{"success": false, "err": "Student not added: ' . $student_id_er . $class_id_er . $q_er . '"}';
            }
            

        } 
        //if student is already enrolled in class
        else {
            // send message that student is already enrolled
            echo '{"success": false, "err": "Student is already enrolled in this class."}';
        }
    }
  
  //$result = $stmt->get_result();
  //echo_json_encode_db($result);

  if ($c1 && $c2 ) {
    echo '{"success": true, "err": "none"}';
  }
  include "disconndb.php";
?>
