<?php 
require "./conndb.php";
require "./testdata.php";
?>

<h3 class="title"> Edit a Class</h3>

Current Class Name:<br><br><select id="class_id" name="class_id">

<?php
// Check connection
if (mysqli_connect_errno($conn))
  {

  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  // prepare and bind
    // prepare and bind
    $stmt = $conn->prepare("SELECT class_id, name FROM Class WHERE tutor_uname=(?)");
    $stmt->bind_param("s", $tutor_uname);

    $tutor_uname = $_SESSION["username"];

    if ($stmt->execute() === TRUE) {
        $result = $stmt->get_result();
      } else {
        echo '{"success": false, "err": "Could not get tutor username." }';
      }

    while ($row = $result->fetch_assoc()) {
        echo "<option value=\"" . $row["class_id"] . "\">" . $row["name"] . "</option>";
    }
  ?>
</select><br><br>
New Class Name:<br><input id="name" type="text" name="name" value="" ><br><br>
Topic:<br><select id="topic" name="topic">

<?php 
  // prepare and bind
  $stmt1 = "SELECT topic_id, name FROM Topic;";

  $result1 = $conn->query($stmt1);


    while ($row1 = $result1->fetch_assoc()) {
        echo "here too";
        echo "\<option value=\"" . $row1["topic_id"] . "\">" . $row1["name"] . "</option>";
    }

  include "disconndb.php";
  ?>
</select><br><br>
Description:<br><textarea id="description" name="description" rows="10" cols="30">We will be reviewing Math 30-1 in 4 sessions.
    </textarea><br><br>
Open Enrollment:
<label>
    <input type="radio" name="enroll_open" id="enroll_open" value=1 />Yes</label>
<label>
    <input type="radio" name="enroll_open" id="enroll_open" value=0 />No</label><br><br>
<br><button type="button" onclick="loadEditClassForm()">Submit</button>

<!-- Need to link: class_id, tutor_uname, topic_id -->