<?php 
    require "./conndb.php";
    require "./testdata.php";
?>

<h3 class="title">Enroll your student into a class: </h3>
Select Class:&nbsp;<select id="class_id" name="class_id">
<?php
    // Check connection
    if (mysqli_connect_errno($conn))
    {

    //echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
        // prepare and bind
    $stmt = "SELECT class_id, name FROM Class;";

    $result = $conn->query($stmt);

    while ($row = $result->fetch_assoc()) {
            echo "\<option value=\"" . $row["class_id"] . "\">" . $row["name"] . "</option>";
    }
?> 
  </select>
  <br><br> 
  Select Student:&nbsp;<select id="student_id" name="student_id">
<?php
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
        echo "<option value=\"" . $row["student_id"] . "\">" . $row["first_name"] ." ". $row["last_name"] . "</option>";
    }
    include "disconndb.php";
  ?> 
  </select>
  <br><br> 

<br><br><button type="button" onclick="loadEnrollStudentForm()">Submit</button>

<!-- Need to link: class_id, incrementing session number, location_id, sched_item_id, tutor_id -->
<!-- Also this includes data for SCHEDULE_ITEM: date, start_time, end_time -->
<!-- Also don't know if open enrollment should be here or only in the add class form -->