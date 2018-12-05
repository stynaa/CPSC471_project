<h3> Edit Student Information: </h3>

Select Student:<br><select id="student_id" name="student_id">
<?php 
require "./conndb.php";
require "./testdata.php";

// Check connection
if (mysqli_connect_errno($conn))
  {

  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  // prepare and bind
    // prepare and bind
    $stmt = $conn->prepare("SELECT student_id, first_name, last_name FROM Student WHERE parent_uname=(?)");
    $stmt->bind_param("s", $parent_uname);

    $parent_uname = $_SESSION["username"];

    if ($stmt->execute() === TRUE) {
        $result = $stmt->get_result();
      } else {
        echo '{"success": false, "err": "Could not get parent username." }';
      }

    while ($row = $result->fetch_assoc()) {
        echo "<option value=\"" . $row["student_id"] . "\">" . $row["first_name"] . " " . $row["last_name"] . "</option>";
    }
  //$result = $stmt->get_result();
  //echo_json_encode_db($result);

  include "disconndb.php";
  ?>
</select><br><br>  

First Name:<br><input id="first_name" type="text" name="first_name" value="" ><br>
Last Name:<br><input id="last_name" type="text" name="last_name" value="" ><br>
Date of Birth:<br><input id="dob" type="date" name="dob" value=""><br>
<br><button type="button" onclick="loadEditStudentForm()">Submit</button>
