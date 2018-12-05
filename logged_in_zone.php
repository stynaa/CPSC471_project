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

        <div id="parentbtns" style="display:none;" class="clearfix">
            <button class="navb" onclick="loadAddStudent()">Add Student</button>
            <button class="navb" onclick="loadEditStudent()">Edit Student Information</button>
            <button class="navb" onclick="loadAddReview()">Add Review</button>
            <button class="navb" onclick="loadEnrollStudent()">Enroll Student</button>
            <button class="navb" id="vs" onclick="showQueryResults()">View Students</button>
        </div>
        <div id="tutorbtns" style="display:none;" class="clearfix">
            <button class="navb" onclick="loadAddClass()">Add Class</button>
            <button class="navb" onclick="loadEditClass()">Edit Class</button>
            <button class="navb" onclick="loadAddLocation()">Add Location</button>
            <button class="navb" onclick="loadAddSession()">Add Session</button>
            <button class="navb" onclick="loadEditSession()">Edit Session</button>
            <button class="navb" onclick="loadAddTopic()">Add Topic</button>
            <button class="navb" onclick="loadAddTopicKnow()">Add Topic Knowledge</button>
        </div>

        <form id="form" style="float: left">
        </form>

        <div id="query-results" style="display: none; float: right">
        </div>
        <script>
            function showQueryResults() {
                viewStudents();
                var x = document.getElementById("query-results");
                var b = document.getElementById("vs");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    b.style.backgroundColor = "lightgrey";
                } else {
                    x.style.display = "none";
                    b.style.backgroundColor = "#4CAF50";
                }
            }
        </script>
        <script type="text/javascript" src="js/studentViews.js"></script>
        <script type="text/javascript" src="js/buttonLoaders.js"></script>
        <script type="text/javascript" src="js/formLoaders.js"></script>
        <script type="text/javascript" src="js/loadDoc.js"></script>
        <script type="text/javascript" src="js/navbarauth.js"></script>
    </body>
</html>
