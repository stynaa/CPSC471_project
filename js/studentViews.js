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
