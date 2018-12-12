<?php
require "conndb.php";
require "testdata.php";

/* your php code below
* $conn is database connection
* $_SESSION["username"] is username of logged in user
*/

//validate & verify & cleanse input data (if any)

$class_id = test_input($_GET["class_id"]);

$stmt = $conn->prepare("SELECT s.student_id, s.dob, s.first_name, s.last_name, s.parent_uname, e.enrollment_date FROM Student AS s INNER JOIN Enrolled AS e ON s.student_id = e.student_id WHERE e.class_id = ?");
$stmt->bind_param("i", $class_id);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    echo '<h3 class="title">Your Students:</h3>';
    echo "<table>";
    echo '<th>Student ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Parent Username</th><th>Enrollment Date</th>';
    while($x = $result->fetch_assoc()) {
        echo '<tr>' . '<td>'.$x["student_id"].'</td><td>'.$x["first_name"].
            '</td><td>'.$x["last_name"].'</td><td>'.$x["dob"].'</td><td>'.
            $x["parent_uname"].'</td><td>'.$x["enrollment_date"].'</td><td>'.
            '</tr>';
    }
    echo "</table>";
} else {
    echo "e";
}

/* end of your php code */
include "disconndb.php";
?>
