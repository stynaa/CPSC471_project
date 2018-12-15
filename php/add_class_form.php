<?php 
require "./conndb.php";
require "./testdata.php";
?>

<h3 class="title">Add a new class: </h3>
Class Name:<br><input id="name" type="text" name="name" value="" ><br><br>
Topic:<br><select id="topic" name="topic">

<?php
// Check connection
if (mysqli_connect_errno($conn))
  {

  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  // prepare and bind
  $stmt = "SELECT topic_id, name FROM Topic;";

  $result = $conn->query($stmt);

    while ($row = $result->fetch_assoc()) {
        echo "\<option value=\"" . $row["topic_id"] . "\">" . $row["name"] . "</option>";
    }


  //$result = $stmt->get_result();
  //echo_json_encode_db($result);

  include "disconndb.php";
  ?>
</select><br><br>
Description:<br><textarea id="description" name="description" rows="10" cols="30">We will be reviewing Math 30-1 in 4 sessions.
    </textarea><br><br>
Open Enrollment:
<label>
    <input type="radio" name="enroll_open" id="enroll_open" value=1 checked=1 />Yes</label>
<label>
    <input type="radio" name="enroll_open" id="enroll_open" value=0 />No</label><br><br>
<br><button type="button" onclick="loadAddClassForm()">Submit</button>

<!-- Need to link: class_id, tutor_uname, topic_id -->