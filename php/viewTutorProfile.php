<?php
require "conndb.php";
require "./testdata.php";

/* your php code below
* $conn is database connection
* $_SESSION["username"] is username of logged in user
*/

//validate & verify & cleanse input data (if any)
$username = testdata($_POST["username"]);

$stmt = $conn->prepare("SELECT * FROM Tutor AS t LEFT JOIN User AS u ON t.username = u.username WHERE u.username=?");
$stmt->bind_param("s", $username);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    while($x = $result->fetch_assoc()) {
        echo "<h3>" . $x["first_name"] . " " . $x["last_name"] . "'s Profile</h3>";
        echo "<table>";
        echo '<th>Username:</th><td>' . $x["username"] .'</td>';
        echo '<tr><th>First Name:</th><td>'. $x["first_name"] . '</td></tr>' .
            '<tr><th>Last Name:</th><td>'. $x["last_name"] . '</td></tr>' .
            '<tr><th>Education:</th><td>'. $x["education"] . '</td></tr>' .
            '<tr><th>Bio:</th><td>'. $x["bio"] . '</td></tr>' .
            '<tr><th>City:</th><td>'. $x["city"] . '</td></tr>' .
            '<tr><th>Phone Number: </th><td><a href="tel:'.$x["phone"].'">'.$x["phone"].'</a></td></tr>' .
            '<tr><th>Email:</th><td><a href="mailto:'.$x["email"].'">'.$x["email"].'</a></td></tr>' ;
    }
    echo "</table>";
} else {
    echo "e";
}

echo "<br><br><h3>Topic Knowledge: </h3>";
$stmt = $conn->prepare("SELECT t.name, k.knowledge_level FROM Topic AS t, Tutor_topic_knowledge AS k WHERE t.topic_id=k.topic_id AND k.username=(?);");
$stmt->bind_param("s", $username);

if ($stmt->execute())
{
    $result = $stmt->get_result();
    echo "<table>";
    echo '<th>Topic</th><th>Knowledge Level</th>';
    while($x = $result->fetch_assoc())
    {
        echo '<tr><td>' . $x["name"] .
         '</td><td>' . $x["knowledge_level"] .
         '</td></tr>';
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
    echo "</table><br><br><br>";
} else {
    echo "e";
}


/* end of your php code */
include "disconndb.php";
?>
