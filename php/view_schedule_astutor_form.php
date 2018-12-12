<?php 
    require "./conndb.php";
    require "./testdata.php";
?>

<h3 class="title">Your Schedule: </h3>
<table>
    <tr>
        <th>Start time</th>
        <th>End time</th>
        <th>Class name</th>
        <th>Topic</th>
        <th>Session Number</th>
        <th>Summary</th>
        <th>Location</th>
        <th>Enrollment Open</th>
    </tr>
<?php
    // Check connection
    if (mysqli_connect_errno($conn))
    {

    //echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
        // prepare and bind
    $stmt = $conn->prepare("SELECT i.start_time, i.end_time, l.building_name, s.summary, s.session_num, c.name, t.name AS topic, c.enroll_open 
                FROM Class AS c, Session AS s, Schedule_item AS i, Topic AS t, Location AS l
                WHERE c.class_id=s.class_id AND c.topic_id=t.topic_id AND s.sched_item_id=i.schitem_id AND s.location_id=l.location_id AND c.tutor_uname=(?);");
    $stmt->bind_param("s", $tutor_uname);

    $tutor_uname = $_SESSION["username"];

    if ($stmt->execute() === TRUE) {
        $result = $stmt->get_result();
      } else {
        echo '{"success": false, "err": "Could not get tutor schedule." }';
      }
    
    $enrolBool = "no";

    while ($row = $result->fetch_assoc()) {
        $enrolBool = "no";
        if ($row["enroll_open"] == 1)
        {
            $enrolBool = "yes";
        }
        echo "<tr><td>" . $row["start_time"] . 
        "</td><td>" . $row["end_time"] .
        "</td><td>". $row["name"] .
        "</td><td>". $row["topic"] .
        "</td><td>". $row["session_num"] .
        "</td><td>". $row["summary"] .
        "</td><td>". $row["building_name"] .
        "</td><td>". $enrolBool .
         "</td></tr>";
    }
    include "disconndb.php";
  ?> 
  </table>
  <br><br> 