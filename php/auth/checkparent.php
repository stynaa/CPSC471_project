<?php
if (!isset($_SESSION)) {
    session_start();
}
if(!array_key_exists('username', $_SESSION)){
    echo '{"isparent": false}';
    die();
}

require "../conndb.php";
$parent = FALSE;

$checkparent = $conn->prepare("SELECT COUNT(*) FROM Parent WHERE username = ?");
$checkparent->bind_param("s", $_SESSION["username"]);

if ($checkparent->execute() === TRUE) {
    $res = $checkparent->get_result();
    $row = $res->fetch_assoc();
    if($row["COUNT(*)"] > 0) {
        $parent = TRUE;
    }
}
$checkparent->close();
include "../disconndb.php";
if ($parent) {
    echo '{"isparent": true}';
} else {
    echo '{"isparent": false}';
}
?>
