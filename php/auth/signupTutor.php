<?php
require "../conndb.php";
require "../testdata.php";
/* your php code below
* $conn is database connection
* $_SESSION["username"] is username of logged in user
*/

//validate & verify & cleanse input data (if any)
$username = test_input($_POST["username"]);
if (!isa_username($username)) {
    echo '{"tutorCreated": false, "err": "Username not valid: '. $_POST["username"].'"}';
    die();
}
$pw1 = test_input($_POST["pw"]);
$pw2 = test_input($_POST["pwcheck"]);
if (!($pw1 == $pw2)) {
    echo '{"tutorCreated": false, "err": "Passwords do not match."}';
    die();
}
$email = test_input($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '{"tutorCreated": false, "err": "Email not valid."}';
    die();
}
$phone = test_input($_POST["phone"]);
if (!isa_phone($phone)) {
    echo '{"tutorCreated": false, "err": "Phone number not valid."}';
    die();
}
$first_name = test_input($_POST["first_name"]);
$last_name = test_input($_POST["last_name"]);
if (!isa_name($first_name) || !isa_name($last_name)) {
    echo '{"tutorCreated": false, "err": "Name not valid."}';
    die();
}

$bio = test_input($_POST["bio"]);
$education = test_input($_POST["education"]);
$housenum = test_input($_POST["housenum"]);
$street = test_input($_POST["street"]);
$city = test_input($_POST["city"]);
$pcode = test_input($_POST["pcode"]);
if (!isa_number($housenum)) {
    echo '{"tutorCreated": false, "err": "Address not valid."}';
    die();
}

$password = $pw1;

//Check if username exists
$chkuname = $conn->prepare("SELECT COUNT(*) FROM User WHERE username = ?");
$chkuname->bind_param("s", $username);

if ($chkuname->execute() === TRUE) {
    $res = $chkuname->get_result();
    $row = $res->fetch_assoc();
    if($row["COUNT(*)"] > 0) {
        echo '{"tutorCreated": false, "err": "Username already exists."}';
        $chkuname->close();
        die();
    }
} else {
    echo '{"tutorCreated": false, "err": "Database failure. -- chk"}';
    $chkuname->close();
    die();
}
$chkuname->close();

//construct & run sql statement
$insertUser = $conn->prepare("INSERT INTO User (username, email, phone, first_name, last_name) VALUES (?,?,?,?,?)");
if($insertUser) {
    $insertUser->bind_param("sssss", $username, $email, $phone, $first_name, $last_name);
} else {
    var_dump($insertUser);
    die();
}

if ($insertUser->execute() === TRUE) {
    $insertUser->close();

    $t1 = $t2 = FALSE;
    $insertpw = $conn->prepare("INSERT INTO Login_data (username, password_sha, last_login) VALUES (?, ?, CURRENT_TIMESTAMP)");
    $insertpw->bind_param("ss", $username, $password);
    if ($insertpw->execute() === TRUE) {
        $t1 = TRUE;
    } else {
        echo '{"tutorCreated": false, "err": "Database failure - pw"}';
        die();
    }
    $insertpw->close();


    $inserttutor = $conn->prepare("INSERT INTO Tutor (username, bio, education, house_num, street, city, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $inserttutor->bind_param("sssisss", $username, $bio, $education, $housenum, $street, $city, $pcode);
    if ($inserttutor->execute() === TRUE) {
        $t2 = TRUE;
    } else {
        echo '{"tutorCreated": false, "err": "Database failure -- tutor"}';
        echo var_dump($inserttutor);
        die();
    }
    $inserttutor->close();

    if($t1 && $t2) {
        echo '{"tutorCreated": true, "err": "none"}';
    }

} else {
    $insertUser->close();
    echo '{"tutorCreated": false, "err": "Database failure -- insert user"}';
}


/* end of your php code */
include "../disconndb.php";
?>
