<?php
require "php/conndb.php";
require "php/testdata.php";
?>
<h2 class="title">Write Review:</h2>
Select Tutor:<br><select id="tutor_uname">
<?php
    $stmt = $conn->prepare("SELECT DISTINCT c.tutor_uname FROM Class AS c WHERE c.class_id IN (SELECT e.class_id FROM Enrolled AS e WHERE e.student_id IN (SELECT s.student_id FROM Student AS s WHERE s.parent_uname = ?))");
    $stmt->bind_param("s", $parent_uname);

    $parent_uname = $_SESSION["username"];

    if ($stmt->execute() === TRUE) {
        $result = $stmt->get_result();
      } else {
        echo '{"success": false, "err": "Could not get parent username." }';
      }

    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row["tutor_uname"] . '">' . $row["tutor_uname"] . '</option>';
    }

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
