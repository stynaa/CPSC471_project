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
            <button onclick="loadAddReview()">Add Review</button>
        </div>
        <div id="tutorbtns" style="display:none;">
            <button onclick="loadAddClass()">Add Class</button>
            <button onclick="loadAddLocation()">Add Location</button>
            <button onclick="loadAddSession()">Add Session</button>
            <button onclick="loadAddTopic()">Add Topic</button>
            <button onclick="loadAddTopicKnow()">Add Topic Knowledge</button>
        </div>
        <form id="form">
        </form>

        <script>
            function loadAddClass() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        document.getElementById("form").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "php/add_class_form.php", true);
                xhttp.send();
            }
            function loadAddLocation() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("form").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "add_location_form.html", true);
                xhttp.send();
            }
            function loadAddReview() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("form").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "add_review_form.html", true);
                xhttp.send();
            }
            function loadAddSession() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("form").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "add_session_form.html", true);
                xhttp.send();
            }
            function loadAddStudent() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("form").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "add_student_form.html", true);
                xhttp.send();
            }
            function loadAddTopic() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("form").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "add_topic_form.html", true);
                xhttp.send();
            }
            function loadAddTopicKnow() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        document.getElementById("form").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "php/add_topicknow_form.php", true);
                xhttp.send();
            }

            function showTutorButtons() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let x = JSON.parse(this.responseText);
                        if (x.istutor == true) {
                            document.getElementById("tutorbtns").setAttribute("style", "display:inline;");
                        }
                    }
                }
                xhttp.open("GET", "php/auth/checktutor.php", true);
                xhttp.send();
            }

            function showParentButtons() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let x = JSON.parse(this.responseText);
                        if(x.isparent) {
                            document.getElementById("parentbtns").setAttribute("style", "display:inline;")
                        }
                    }
                };
                xhttp.open("GET", "php/auth/checkparent.php", true);
                xhttp.send();
            }

            showParentButtons();
            showTutorButtons();

        </script>
        <script type="text/javascript" src="js/loadDoc.js"></script>
        <script type="text/javascript" src="js/navbarauth.js"></script>
    </body>
</html>
