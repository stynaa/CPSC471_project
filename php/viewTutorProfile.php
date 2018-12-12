<?php
require "conndb.php";
require "./testdata.php";

/* your php code below
* $conn is database connection
* $_SESSION["username"] is username of logged in user
*/

//validate & verify & cleanse input data (if any)
$username = $_POST["username"];

$stmt = $conn->prepare("SELECT * FROM Tutor AS t LEFT JOIN User AS u ON t.username = u.username WHERE u.username=?");
$stmt->bind_param("s", $username);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    echo "<table>";
    echo '<th>Username</th><th>First Name</th><th>Last Name</th><th>Education</th><th>Bio</th><th>City</th><th>Phone</th><th>Email</th><th>Select</th>';
    while($x = $result->fetch_assoc()) {
        echo '<tr>' . '<td>'.$x["username"].'</td><td>'.$x["first_name"].
            '</td><td>'.$x["last_name"].'</td><td>'.$x["education"].'</td><td>'.
            '</td><td>'.$x["bio"].'</td><td>'.$x["city"].'</td><td>'.
            '</td><td><a href="tel:'.$x["phone"].'">'.$x["phone"].'</a></td><td><a href="mailto:'.$x["email"].'">'.$x["email"].'</td><td>'.
            '</tr>';
    }
    echo "</table>";
} else {
    echo "e";
}

echo "<br><br><h3>Reviews: </h3>";

$stmt = $conn->prepare("SELECT parent_uname, time_stamp, comment, rating FROM Review WHERE tutor_uname=(?)");
$stmt->bind_param("s", $username);

if ($stmt->execute()) 
{
    $result = $stmt->get_result();
    echo "<table>";
    echo '<th>Parent Username</th><th>Time Stamp</th><th>Comment</th><th>Rating</th><th>';
    while($x = $result->fetch_assoc())
    {
        echo '<tr><td>' . $x["parent_uname"] .
            '</td><td>' . $x["time_stamp"] .
            '</td><td>' . $x["comment"] .
            '</td><td>' . $x["rating"] .
            '</td></tr>';
    }
    echo "</table>";
} else {
    echo "e";
}


/* end of your php code */
include "disconndb.php";
?>
