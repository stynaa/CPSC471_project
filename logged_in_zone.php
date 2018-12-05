<?php
if (!isset($_SESSION)) {
    session_start();
}
if(!array_key_exists('username', $_SESSION)){
    header('Location: signup.html');
    die();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/master.css">
        <title></title>
    </head>
    <body>

        <div id="parentbtns" style="display:none;">
            <button onclick="loadAddStudent()">Add Student</button>
            <button onclick="loadEditStudent()">Edit Student Information</button>
            <button onclick="loadAddReview()">Add Review</button>
        </div>
        <div id="tutorbtns" style="display:none;">
            <button onclick="loadAddClass()">Add Class</button>
            <button onclick="loadEditClass()">Edit Class</button>
            <button onclick="loadAddLocation()">Add Location</button>
            <button onclick="loadAddSession()">Add Session</button>
            <button onclick="loadEditSession()">Edit Session</button>
            <button onclick="loadAddTopic()">Add Topic</button>
            <button onclick="loadAddTopicKnow()">Add Topic Knowledge</button>
        </div>

        <form id="form">
        </form>

        <div id="query-results">

        </div>

        <script type="text/javascript" src="js/buttonLoaders.js"></script>
        <script type="text/javascript" src="js/formLoaders.js"></script>
        <script type="text/javascript" src="js/loadDoc.js"></script>
        <script type="text/javascript" src="js/navbarauth.js"></script>
    </body>
</html>
