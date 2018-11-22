<?php
require "conndb.php";
/* your php code below
* $conn is database connection
* $_SESSION["username"] is username of logged in user
*/

//validate & verify & cleanse input data (if any)

//construct & run sql statement
$sql = "SELECT username, email, phone, first_name, last_name FROM User";
$result = $conn->query($sql);


$stmt = $conn->prepare("SELECT username, email, phone, first_name, last_name FROM User WHERE username=?");
$stmt->bind_param("s", $username);

$username = $_POST["username"];

if ($stmt->execute() === TRUE) {
    $result = $stmt->get_result();
    echo_json_encode_db($result);
  } else {
    echo "e";
  }



/* end of your php code */
include "disconndb.php";
?>
