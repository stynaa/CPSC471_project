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
  $error = false;

  if (empty($_POST["bld_number"])) {
    $error = true;
    $bld_number_er = "Building number is required. ";
  } else {
    $bld_number = test_input($_POST["bld_number"]);
    // check if building number is a number
    if (!isa_number($bld_number)) {
      $error = true;
      $bld_number_er = "Building number is not a number. Please enter a valid building number. ";
    }
  }

  if (empty($_POST["street"])) {
    $error = true;
    $street_er = "Street name is required. ";
  } else {
    $street = test_input($_POST["street"]);
    if (!isa_classname($street)) {
      $error = true;
      $street_er = "Street name must be max 64 characters. Please enter a valid street name. ";
    }
  }

  if (empty($_POST["city"])) {
    $error = true;
    $city_er = "City name is required. ";
  } else {
    $city = test_input($_POST["city"]);
    if (!isa_name($city)) {
      $error = true;
      $city_er = "City name must be max 64 characters and can only contain letters and dashes('-'). Please enter a valid city name. ";
    }
  }

  if (empty($_POST["postal_code"])) {
    $error = true;
    $postal_code_er = "Postal code is required. ";
  } else {
    $postal_code = test_input($_POST["postal_code"]);
    if(!isa_postalcode($postal_code)) {
        $error = true;
        $postal_code_er = "Invalid postal code. Please write in format A1A 1A1. ";
    }
  }

  if (empty($_POST["building_name"])) {
    $error = true;
    $building_name_er = "Building name is required. ";
  } else {
    $building_name = test_input($_POST["building_name"]);
    if(!isa_classname($building_name)) {
      $error = true;
      $building_name_er = "Building name must be max 64 characters. Please enter valid building name. ";
    }
  }

  if (!$error) {
    if ($stmt->execute() === TRUE) {
      echo '{"success": true, "err": "none"}';
    } else {
      echo '{"success": false, "err": "' . $building_name_er . $bld_number_er . $street_er . $city_er . $postal_code_er . '"}';
    }
  } else {
    echo '{"success": false, "err": "' . $building_name_er . $bld_number_er . $street_er . $city_er . $postal_code_er . '"}';
  }


  //$result = $stmt->get_result();
  //echo_json_encode_db($result);

  include "disconndb.php";
?>
