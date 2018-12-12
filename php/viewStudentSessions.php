<?php
require "conndb.php";
require "./testdata.php";

/* your php code below
* $conn is database connection
* $_SESSION["username"] is username of logged in user
*/

//validate & verify & cleanse input data (if any)

$student_id = test_input($_POST["student_id"]);

$stmt = $conn->prepare("SELECT e.class_id, e.enrollment_date, s.session_num, s.summary, l.bld_number, l.street, l.city, l.postal_code, l.building_name FROM (Enrolled AS e LEFT OUTER JOIN Session AS s ON s.class_id = e.class_id) LEFT OUTER JOIN Location AS l ON s.location_id = l.location_id WHERE e.student_id=?");
$stmt->bind_param("s", $student_id);

$username = getUsername();

if($username != -1) {
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        echo "<table>";
        echo '<th>Class id</th><th>Enrollment Date</th><th>Session Number</th><th>Summary</th><th>Adress</th><th>building_name</th>';
        while($x = $result->fetch_assoc()) {
            echo '<tr>' . '<td>'.$x["class_id"].'</td><td>'.$x["enrollment_date"].'</td>'.
                '<td>'.$x["session_num"].'</td><td>'.$x["summary"].'</td>'.
                '<td>'.$x["bld_number"].' '.$x["street"].' '.$x["city"].', '.$x["postal_code"].'</td>'.
                '<td>'.$x["building_name"].'</td>'.
                //'<td><button onclick="dropSession('.$student_id .','. $x[""].')">Drop Session</button></td>'.
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
