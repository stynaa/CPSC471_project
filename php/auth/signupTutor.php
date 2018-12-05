<?php
require "../conndb.php";
/* your php code below
* $conn is database connection
* $_SESSION["username"] is username of logged in user
*/

//validate & verify & cleanse input data (if any)
$username = $_POST["username"];
$pw1 = $_POST["pw"];
$pw2 = $_POST["pwcheck"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$bio = $_POST["bio"];
$education = $_POST["education"];
$housenum = $_POST["housenum"];
$street = $_POST["street"];
$city = $_POST["city"];
$pcode = $_POST["pcode"];

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
