<?php
if (!isset($_SESSION)) {
    session_start();
}
if(!array_key_exists('username', $_SESSION)){
    echo '{"istutor": false}';
    die();
}

require "../conndb.php";
$tutor = FALSE;

$checktutor = $conn->prepare("SELECT COUNT(*) FROM Tutor WHERE username = ?");
$checktutor->bind_param("s", $_SESSION["username"]);

if ($checktutor->execute() === TRUE) {
    $res = $checktutor->get_result();
    $row = $res->fetch_assoc();
    if($row["COUNT(*)"] > 0) {
        $tutor = TRUE;
    }
}
$checktutor->close();
include "../disconndb.php";
if ($tutor) {
    echo '{"istutor": true}';
} else {
    echo '{"istutor": false}';
}
?>
