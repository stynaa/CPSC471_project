<?php
require "conndb.php";
require "./testdata.php";

/* your php code below
* $conn is database connection
* $_SESSION["username"] is username of logged in user
*/

//validate & verify & cleanse input data (if any)

$student_id = test_input($_POST["student_id"]);
$class_id = test_input($_POST["class_id"]);

$stmt = $conn->prepare("DELETE FROM Enrolled WHERE class_id=? AND student_id=?");
$stmt->bind_param("ss", $class_id, $student_id);

$username = getUsername();

if ($stmt->execute()) {
    $result = $stmt->get_result();
    echo "<p>Class dropped.</p>";
  } else {
    echo "e";
  }

/* end of your php code */
include "disconndb.php";
?>
