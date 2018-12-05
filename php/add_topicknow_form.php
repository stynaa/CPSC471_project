<?php 
require "./conndb.php";
require "./testdata.php";
?>

<h3 class="title">Set Knowledge Level:</h3>
Topic:&nbsp;<select id="topic_id" name="topic_id">
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
</select>&nbsp;&nbsp;
Knowledge Level:&nbsp;<select id="knowledge_level" name="knowledge_level">
    <option value=1>1 - no knowledge </option>
    <option value=2>2 </option>
    <option value=3>3 </option>
    <option value=4>4 </option>
    <option value=5>5 </option>
    <option value=6>6 </option>
    <option value=7>7 </option>
    <option value=8>8 </option>
    <option value=9>9 </option>
    <option value=10>10 - expert </option>
</select> <br><br>
<br><button type="button" onclick="loadAddTopicKnowledgeForm()">Submit</button>

<!--Need to change topic to drop down menu, link tutor_uname-->