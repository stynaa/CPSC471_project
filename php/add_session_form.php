<?php 
require "./conndb.php";
require "./testdata.php";
?>
<h3 class="title">Add Class Session: </h3>
Select Class:&nbsp;<select id="class_id" name="class_id">

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
        echo '{"success": false, "err": "Could not get tutor username. " }';
      }

    while ($row = $result->fetch_assoc()) {
        echo "<option value=\"" . $row["class_id"] . "\">" . $row["name"] . "</option>";
    }
  ?> 
  </select>
  <br><br> 
  Session number:<select id="session_num" name="session_num">
        <option value=1>1 </option>
        <option value=2>2 </option>
        <option value=3>3 </option>
        <option value=4>4 </option>
        <option value=5>5 </option>
        <option value=6>6 </option>
        <option value=7>7 </option>
        <option value=8>8 </option>
        <option value=9>9 </option>
        <option value=10>10 </option>
    </select><br><br>

Start Time:&nbsp;<input id="start_time" type="datetime-local" name="start_time"><br><br> 
End Time:&nbsp;<input id="end_time" type="datetime-local" name="end_time"><br><br>

Location:<br><select id="location_id" name="location_id">
<?php
    $stmt = "SELECT location_id, building_name FROM Location";

    $result = $conn->query($stmt);

    while ($row = $result->fetch_assoc()) {
        echo "\<option value=\"" . $row["location_id"] . "\">" . $row["building_name"] . "</option>";
    }

  include "disconndb.php";

  ?>
</select><br><br>
Session summary:<br><textarea id="summary" name="summary" rows="10" cols="30">We will be reviewing exponents in this session.
    </textarea><br><br>
Open Availability:
<label>
    <input type="radio" name="avail_flag" id="avail_flag" value=1 />Yes</label>
<label>
    <input type="radio" name="avail_flag" id="avail_flag" value=0 />No</label>
<br><br><button type="button" onclick="loadAddSessionForm()">Submit</button>

<!-- Need to link: class_id, incrementing session number, location_id, sched_item_id, tutor_id -->
<!-- Also this includes data for SCHEDULE_ITEM: date, start_time, end_time -->
<!-- Also don't know if open enrollment should be here or only in the add class form -->