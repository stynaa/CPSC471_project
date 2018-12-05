<?php
require "php/conndb.php";
require "php/testdata.php";
?>
<h2>Write Review:</h2>
Select Tutor:<br><select id="tutor_uname">
<?php
/*
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
*/
  include "disconndb.php";
  ?>
</select><br><br>

Comment:<br><textarea id="comment" name="comment" rows="10" cols="30">My child enjoyed learning from this tutor. Thanks!
    </textarea><br><br>
Rating:<br><select id="rating" name="rating">
    <option value=1>1 - poor </option>
    <option value=2>2 </option>
    <option value=3>3 </option>
    <option value=4>4 </option>
    <option value=5>5 </option>
    <option value=6>6 </option>
    <option value=7>7 </option>
    <option value=8>8 </option>
    <option value=9>9 </option>
    <option value=10>10 - excellent </option>
</select> <br>
<br><button type="button" onclick="loadDoc()">Submit</button>

<!-- Need to Link: parent_uname, tutor_uname -->
