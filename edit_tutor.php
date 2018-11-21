<?php

require "./conn.php";
require "./testdata.php";

// Check connection
if (mysqli_connect_errno($con))
  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $usernameErr = $bioErr = $educationErr = $house_numErr = $streetErr = $cityErr = $postal_codeErr = "";
  $username = $bio = $education = $house_num = $street = $city = $postal_code = "";

  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
  } else {
    $username = test_input($_POST["username"]);
  }

  if (empty($_POST["bio"])) {
    $bioErr = "";
  } else {
    $bio = test_input($_POST["bio"]);
  }

  if (empty($_POST["education"])) {
    $educationErr = "Education is required";
  } else {
    $education = test_input($_POST["education"]);
  }

  if (empty($_POST["house_num"])) {
    $house_numErr = "House number is required";
  } else {
    $house_num = test_input($_POST["house_num"]);
    // check if house number only contains numbers
    if (!preg_match("/^[0-9]*$/",$house_num)) {
      $house_numErr = "Only numbers allowed"; 
    }
  }

  if (empty($_POST["street"])) {
    $streetErr = "Street name is required";
  } else {
    $street = test_input($_POST["street"]);
    // check if street name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$street)) {
      $streetErr = "Only letters and white space allowed"; 
    }
  }

  if (empty($_POST["city"])) {
    $cityErr = "City name is required";
  } else {
    $city = test_input($_POST["city"]);
    // check if city only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
      $cityErr = "Only letters and white space allowed"; 
    }
  }

  if (empty($_POST["postal_code"])) {
    $postal_codeErr = "Postal code is required";
  } else {
    $postal_code = test_input($_POST["postal_code"]);
    // check if postal code fits format L0L 0L0
    if (!preg_match("/^[a-zA-Z]+[0-9]+[a-zA-Z]+[ ]+[0-9]+[a-zA-Z]+[0-9]$/",$postal_code)) {
      $postal_codeErr = "Only letters and white space allowed"; 
    }
  }

  echo "<h2>Your Input:</h2>";
  echo $username;
  echo "<br>";
  echo $bio;
  echo "<br>";
  echo $education;
  echo "<br>";
  echo $house_num;
  echo "<br>";
  echo $street;
  echo "<br>";
  echo $city;

  $result = mysqli_query($con,"update Tutor set bio='".$bio. 
  "', education='". $education. 
  "', house_num='". $house_num. 
  "', street='". $street. 
  "', city='". $city. 
  "', postal_code='". $postal_code. 
  "' where username=". $username);  

  if ($con->query($result) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $result . "<br>" . $con->error;
}

/*
  $result = mysqli_query($con,"SELECT * FROM Tutor");

echo "<table border='1'>
<tr>
<th>username</th>
<th>bio</th>
<th>education</th>
<th>house_num</th>
<th>street</th>
<th>city</th>
<th>postal_code</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['bio'] . "</td>";
  echo "<td>" . $row['education'] . "</td>";
  echo "<td>" . $row['house_num'] . "</td>";
  echo "<td>" . $row['street'] . "</td>";
  echo "<td>" . $row['city'] . "</td>";
  echo "<td>" . $row['postal_code'] . "</td>";
  echo "<td><a href='update.php?ID= " . $row['ID'] . "'>Update</a></td>";
  echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='view.php?job=delete&amp;ID= " . $row['ID'] . "'>DELETE</a></td>";
  
  echo "</tr>";
  }
echo "</table>";
*/

mysqli_close($con);
?>
