function showStudentList() {
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
function viewClasses(student_id) {
    var formData = new FormData();
    formData.append("student_id", student_id);

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

function viewSessions(student_id) {
    var formData = new FormData();
    formData.append("student_id", student_id);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("query-results").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "php/viewStudentSessions.php", true);
    xhttp.send(formData);
}


function searchTutors() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("form").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "search_tutors_form.php", true);
    xhttp.send();
}

function getTutorSearchResults() {
    var formData = new FormData();
    formData.append("first_name", document.getElementById('first_name').value);
    formData.append("last_name", document.getElementById('last_name').value);
    formData.append("username", document.getElementById('username').value);
    formData.append("city", document.getElementById('city').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("form").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "php/listTutorSearchResults.php", true);
    xhttp.send(formData);
}


function getTutorAllResults() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("form").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "php/listAllTutorSearchResults.php", true);
    xhttp.send();
}

/* Don't btns for this should be generated by results from search tutors*/
function parentViewTutorProfile(uname) {
    var formData = new FormData();
    formData.append("username", uname);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("form").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "php/viewTutorProfile.php", true);
    xhttp.send(formData);
}

function viewScheduleAsStudent(student_id) {
    var formData = new FormData();
    formData.append("student_id", student_id);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("query-results").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "php/view_schedule_as_student_form.php", true);
    xhttp.send(formData);
}
