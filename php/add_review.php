<?php

require "./conndb.php";
require "./testdata.php";

// Check connection
if (mysqli_connect_errno($conn))
  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  //need to also check tutor uname in sched item maybe...
  $stmt = $conn->prepare("SELECT COUNT(parent_uname) AS count FROM Review WHERE parent_uname=(?) AND tutor_uname=(?)");
  $stmt->bind_param("ss", $parent_uname, $tutor_uname);

  $parent_uname_er = $tutor_uname_er = "";

  $parent_uname = $_SESSION["username"];

  if (empty($_POST["tutor_uname"])) {
    $tutor_uname_er = "Tutor selection is required.";
  } else {
    $tutor_uname  = test_input($_POST["tutor_uname"]);
  }

  if ($stmt->execute() === TRUE) {
      $result = $stmt->get_result();
    } else {
      echo '{"success": false, "err": "Unable to query Reviews: " ' . $parent_uname_er . $tutor_uname_er . '}';
    }

  while ($row = $result->fetch_assoc()) {
   //echo var_dump($row);
        //if there are no previously saved reviews for this tutor
        if ($row["count"]==0) {
            // prepare and bind
            $stmt = $conn->prepare("INSERT INTO Review(parent_uname, tutor_uname, comment, rating) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $parent_uname1, $tutor_uname1, $comment, $rating);
        } else {
            //update
            $stmt = $conn->prepare("UPDATE Review SET comment=(?), rating=(?) WHERE parent_uname=(?) AND tutor_uname=(?)");
            $stmt->bind_param("siss", $comment, $rating, $parent_uname1, $tutor_uname1);
        }

    $comment_er = $rating_er = "";
    $parent_uname1 = $parent_uname;
    $tutor_uname1 = $tutor_uname;

    if (empty($_POST["comment"])) {
        $comment_er = "Comment is required.";
    } else {
        $comment = test_input($_POST["comment"]);
    }

    if (empty($_POST["rating"])) {
        $rating_er = "Rating is required.";
    } else {
        $rating = test_input($_POST["rating"]);
    }

    if ($stmt->execute() === TRUE) {
        echo '{"success": true, "err": "none"}';
    } else {
        echo var_dump($stmt);
        echo '{"success": false, "err": ' . $parent_uname_er . $tutor_uname_er . $comment_er . $rating_er .'}';
    }
}

  include "disconndb.php";
?>
