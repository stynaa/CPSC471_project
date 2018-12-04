<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/master.css">
        <title></title>
    </head>
    <body>

        <a href="login_test.html">to login test</a>
        <p>
        <?php
        echo $_SESSION["username"];
        ?></p>

        <script type="text/javascript" src="js/navbarauth.js"></script>
    </body>
</html>
