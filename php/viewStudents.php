<?php
require "conndb.php";

/* your php code below
* $conn is database connection
* $_SESSION["username"] is username of logged in user
*/

//validate & verify & cleanse input data (if any)


$stmt = $conn->prepare("SELECT * FROM Student WHERE parent_uname=?");
$stmt->bind_param("s", $username);

$username = getUsername();

if($username != -1) {
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        echo '<h3 class="title"> Your Students: </h3>';
        echo "<table>";
        echo '<th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Student ID</th><th>View Classes</th><th>View Sessions</th>';
        while($x = $result->fetch_assoc()) {
            echo '<tr>' . '<td>'.$x["first_name"].'</td><td>'.$x["last_name"].
                '</td><td>'.$x["dob"].'</td><td>'.$x["student_id"].'</td><td>'.
                '<button onclick="viewClasses(' .$x["student_id"] . ')">View Classes</button>'.
                '</td><td><button onclick="viewSessions(' .$x["student_id"] . ')">View Sessions</button></td>'.
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
