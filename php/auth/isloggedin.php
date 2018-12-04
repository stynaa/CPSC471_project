<?php
    session_start();
    if(array_key_exists('username', $_SESSION)){
        echo '{"status":true, "username": "' . $_SESSION["username"] . '"}';
    } else {
        echo '{"status":false}';
    }
?>
