<?php

require "./conndb.php";
require "./testdata.php";

// Check connection
if (mysqli_connect_errno($conn))
  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  //@class_id, @name, @description, @enroll_open, @tutor_name, @topic

  // prepare and bind
  $stmt = $conn->prepare("INSERT INTO Location(bld_number, street, city, postal_code, building_name) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("issss", $bld_number, $street, $city, $postal_code, $building_name);

  $bld_number_er = $street_er = $city_er = $postal_code_er = $building_name_er = "";

  if (empty($_POST["bld_number"])) {
    $bld_number_er = "Building number is required.";
  } else {
    $bld_number = test_input($_POST["bld_number"]);
    // check if building number is a number
    if (!preg_match("/^[0-9]*$/",$bld_number)) {
      $bld_number_er = "Topic ID not valid (backend issue)"; 
    }
  }

  if (empty($_POST["street"])) {
    $street_er = "Class name is required.";
  } else {
    $street = test_input($_POST["street"]);
  }

  if (empty($_POST["city"])) {
    $city_er = "City name is required.";
  } else {
    $city = test_input($_POST["city"]);
  }

  if (empty($_POST["postal_code"])) {
    $postal_code_er = "Postal code is required.";
  } else {
    $postal_code = test_input($_POST["postal_code"]);
    if(!preg_match("/^[a-zA-Z]+[0-9]+[a-zA-Z]+[0-9]+[a-zA-Z]+[0-9]$/",$postal_code)) {
        $postal_code_er = "Invalid postal code. Please write in format A1A1A1.";
    }
  }

  if (empty($_POST["building_name"])) {
    $building_name_er = "Building name is required.";
  } else {
    $building_name = test_input($_POST["building_name"]);
  }

  if ($stmt->execute() === TRUE) {
    echo '{"success": true, "err": "none"}';
  } else {
    echo '{"success": false, "err": ' . $bld_number_er . $street_er . $city_er . $postal_code_er . $building_name_er .'}';
  }

  //$result = $stmt->get_result();
  //echo_json_encode_db($result);

  include "disconndb.php";
?>
