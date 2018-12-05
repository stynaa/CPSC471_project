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
            <button onclick="viewStudents()">View students</button>
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

        <script type="text/javascript">
            function viewStudents(){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("query-results").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "php/viewStudents.php", true);
                xhttp.send();
            }

            //Note: This is very not secure..
            function viewClasses(studentid) {
                var formData = new FormData();
                formData.append("student_id", studentid);

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("query-results").innerHTML = this.responseText;
                    }
                };
                xhttp.open("POST", "php/viewStudentClasses.php", true);
                xhttp.send(formData);
            }

            function dropCourse(student_id, class_id) {
                var formData = new FormData();
                formData.append("student_id", student_id);
                formData.append("class_id", class_id);

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("query-results").innerHTML = this.responseText;
                    }
                };
                xhttp.open("POST", "php/dropClass.php", true);
                xhttp.send(formData);
            }
        </script>
        <script type="text/javascript" src="js/buttonLoaders.js"></script>
        <script type="text/javascript" src="js/formLoaders.js"></script>
        <script type="text/javascript" src="js/loadDoc.js"></script>
        <script type="text/javascript" src="js/navbarauth.js"></script>
    </body>
</html>
