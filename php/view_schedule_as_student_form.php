<?php 
    require "./conndb.php";
    require "./testdata.php";
?>

<table>
    <tr>
        <th>Start time</th>
        <th>End time</th>
        <th>Class name</th>
        <th>Topic</th>
        <th>Session Number</th>
        <th>Summary</th>
        <th>Location</th>
    </tr>
<?php
    // Check connection
    if (mysqli_connect_errno($conn))
    {

    //echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
        // prepare and bind
    $stmt = $conn->prepare("SELECT i.start_time, i.end_time, l.building_name, s.summary, s.session_num, c.name, t.name AS topic 
                FROM Class AS c, Session AS s, Schedule_item AS i, Topic AS t, Location AS l, Enrolled AS e
                WHERE c.class_id=s.class_id AND c.topic_id=t.topic_id AND s.sched_item_id=i.schitem_id AND s.location_id=l.location_id AND c.class_id=e.class_id AND e.student_id=(?);");
    $stmt->bind_param("s", $student_id);

    $student_id = testdata($_POST["student_id"]);

    if ($stmt->execute() === TRUE) {
        $result = $stmt->get_result();
      } else {
        echo '{"success": false, "err": "Could not get student schedule." }';
      }
    

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["start_time"] . 
        "</td><td>" . $row["end_time"] .
        "</td><td>". $row["name"] .
        "</td><td>". $row["topic"] .
        "</td><td>". $row["session_num"] .
        "</td><td>". $row["summary"] .
        "</td><td>". $row["building_name"] .
         "</td></tr>";
    }
    include "disconndb.php";
  ?> 
  </table>
  <br><br> 