<?php
require "conndb.php";

/* your php code below
* $conn is database connection
* $_SESSION["username"] is username of logged in user
*/

//validate & verify & cleanse input data (if any)

$student_id = $_POST["student_id"];

$stmt = $conn->prepare("SELECT * FROM Class WHERE class_id IN (SELECT class_id FROM Enrolled WHERE student_id=?)");
$stmt->bind_param("s", $student_id);

$username = getUsername();

if($username != -1) {
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        echo "<table>";
        echo '<th>Class Name</th><th>Tutor</th><th>Description</th><th>Enrollment Open</th><th>Drop Class?</th>';
        while($x = $result->fetch_assoc()) {
            echo '<tr>' . '<td>'.$x["name"].'</td><td>'.$x["tutor_uname"].'</td>'.
                '<td>'.$x["description"].'</td><td>'.$x["enroll_open"].
                '</td><td><button onclick="dropCourse('.$student_id .','. $x["class_id"].')">Drop Course</button></td>'.
                '</tr>';
        }
        echo "</table>";
      } else {
        echo "e";
      }
}

/* end of your php code */
include "disconndb.php";
?>
