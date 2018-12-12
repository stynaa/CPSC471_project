<?php
require "conndb.php";
require "./testdata.php";

/* your php code below
* $conn is database connection
* $_SESSION["username"] is username of logged in user
*/

//validate & verify & cleanse input data (if any)

$fname = $_POST["first_name"];
$lname = $_POST["last_name"];
$uname = $_POST["username"];
$city = $_POST["city"];


$stmt = $conn->prepare("SELECT * FROM Tutor AS t LEFT JOIN User AS u ON t.username = u.username WHERE u.first_name LIKE ? AND u.last_name LIKE ? AND u.username LIKE ? AND t.city LIKE ?");
$stmt->bind_param("ssss", $fname, $lname, $uname, $city);

$fname = '%' . $fname . '%';
$lname = '%' . $lname . '%';
$uname = '%' . $uname . '%';
$city = '%' . $city . '%';

if ($stmt->execute()) {
    $result = $stmt->get_result();
    echo '<h3 class="title">Search results (Tutors):</h3>';
    if ($result->num_rows === 0) {
        echo "<p>No results found</p>";
    } else {
        echo "<table>";
        echo '<th>Username</th><th>First Name</th><th>Last Name</th><th>Education</th><th>Bio</th><th>City</th><th>Select</th>';
        while($x = $result->fetch_assoc()) {
            echo '<tr>' . '<td>'.$x["username"].'</td><td>'.$x["first_name"].
                '</td><td>'.$x["last_name"].'</td><td>'.$x["education"].'</td><td>'.
                '</td><td>'.$x["bio"].'</td><td>'.$x["city"].'</td><td>'.
                '<button type="button" onclick="parentViewTutorProfile(\'' . $x["username"] . '\')">View Tutor</button>'.
                '</tr>';
        }
        echo "</table>";
    }
} else {
    echo "e";
}

/* end of your php code */
include "disconndb.php";
?>
