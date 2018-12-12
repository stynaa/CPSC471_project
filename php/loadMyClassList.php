<?php
require "conndb.php";
require "testdata.php";

/* your php code below
* $conn is database connection
* $_SESSION["username"] is username of logged in user
*/

//validate & verify & cleanse input data (if any)

$stmt = $conn->prepare("SELECT * FROM Class WHERE tutor_uname = ?");
$stmt->bind_param("s", $username);

$username = getUsername();

if($username != -1) {
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        echo '<h3 class="title"> Your Students: </h3>';
        echo "<table>";
        echo '<th>Class ID</th><th>Class Name</th><th>Description</th><th>Enrollment Open?</th><th>Topic ID</th><th>View Enrollment List</th>';
        while($x = $result->fetch_assoc()) {
            echo '<tr>' . '<td>'.$x["class_id"].'</td><td>'.$x["name"].
                '</td><td>'.$x["description"].'</td><td>'.$x["enroll_open"].'</td><td>'.
                $x["topic_id"].'</td><td>'.
                '<button type="button" onclick="viewEnrollmentList(' .$x["class_id"] . ')">View Enrollment List</button>'.
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
