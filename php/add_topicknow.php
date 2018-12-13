<?php

require "./conndb.php";
require "./testdata.php";

// Check connection
if (mysqli_connect_errno($conn)) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$username_err = $topic_id_err = $knowledge_level_err = "";
$error = false;

$stmt = $conn->prepare("SELECT COUNT(username) AS count FROM Tutor_topic_knowledge WHERE username=(?) AND topic_id=(?)");
$stmt->bind_param("si", $username, $topic_id);

$username = $_SESSION["username"];

if (empty($_POST["topic_id"])) {
  $error = true;
  $topic_id_err = "Topic ID is required.";
} else {
  $topic_id = test_input($_POST["topic_id"]);
  if (!isa_number($topic_id)) {
    $error = true;
    $topic_id_err = "Topic ID entry is not a number. ";
  }
}

  if ($stmt->execute() === TRUE) {
    $result=$stmt->get_result();
  }

while($row = $result->fetch_assoc()) {
    if ($row["count"] == 0) {
        // prepare and bind
    $stmt = $conn->prepare("INSERT INTO Tutor_topic_knowledge(username, topic_id, knowledge_level) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $username, $topic_id, $knowledge_level);
  } else {
    $stmt = $conn->prepare("UPDATE Tutor_topic_knowledge SET knowledge_level=(?) WHERE username=(?) AND topic_id=(?)");
    $stmt->bind_param("isi", $knowledge_level, $username, $topic_id);
  }
}

  if (empty($_POST["knowledge_level"])) {
    $knowledge_level_err = "Knowledge level is required.";
    $error = true;
    //$knowledge_level_err = test_input($_POST["knowledge_level"]);
  } else {
    $knowledge_level = test_input($_POST["knowledge_level"]);
    if (!isa_rating($knowledge_level)) {
      $error = true;
      $knowledge_level_err = "Knowledge level entry must be a number between 1-10. ";
    }
  }

  if (!$error) {
    if ($stmt->execute() === TRUE) {
      echo '{"success": true, "err": "none"}';
    } else {
      echo '{"success": false, "err": "' .  $username_err . ' '. $topic_id_err . ' '. $knowledge_level_err .'"}';
    }
  } else {
    echo '{"success": false, "err": "' .  $username_err . ' '. $topic_id_err . ' '. $knowledge_level_err .'"}';
  }
  

  //$result = $stmt->get_result();
  //echo_json_encode_db($result);

  include "disconndb.php";
?>
