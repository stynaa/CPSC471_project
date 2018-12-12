<?php
require "../conndb.php";
require "../testdata.php";
/* your php code below
* $conn is database connection
* $_SESSION["username"] is username of logged in user
*/

//to do: validate & verify input data

//prepare, bind & execute login sql statement
$queryCheckUserLoginData = $conn->prepare("SELECT username, password_sha, last_login, num_failed_attempts FROM Login_data WHERE username=?");
$queryCheckUserLoginData->bind_param("s", $username);

$username = test_input($_POST["username"]);
if ($queryCheckUserLoginData->execute() === TRUE) {
    $res = $queryCheckUserLoginData->get_result();
    $row = $res->fetch_assoc();
    if (is_null($row)) {
        echo '{"status": "Fail", "err": "Username or password incorrect"}';
    } else {
        if (test_input($_POST["pw"]) == $row["password_sha"] ) {
            //Set last login, clear num_failed_attempts
            $queryClearFailedLoginAttempts = $conn->prepare("UPDATE Login_data SET num_failed_attempts=0, last_login = CURRENT_TIMESTAMP WHERE username=?");
            $queryClearFailedLoginAttempts->bind_param("s", $username);
            if ($queryClearFailedLoginAttempts->execute() === TRUE) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                //session_regenerate_id(true);
                $_SESSION["username"] = $username;
                echo '{"status": "Success", "username": "' . $username . '"}';
            }
            $queryClearFailedLoginAttempts->close();
        } else {
            $queryClearFailedLoginAttempts = $conn->prepare("UPDATE Login_data SET num_failed_attempts=num_failed_attempts + 1 WHERE username=?");
            $queryClearFailedLoginAttempts->bind_param("s", $username);
            $queryClearFailedLoginAttempts->execute();
            $queryClearFailedLoginAttempts->close();
            echo '{"status": "Fail", "err": "Username or password incorrect"}';
        }
    }
} else {
    echo '{"status": "Fail", "err": "Username or password incorrect"}';
}

$queryCheckUserLoginData->close();

/* end of your php code */
include "../disconndb.php";
?>
