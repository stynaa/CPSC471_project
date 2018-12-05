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
    xhttp.open("GET", "php/add_session_form.php", true);
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

function loadEditStudent() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("form").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "php/edit_student_form.php", true);
    xhttp.send();
}
function loadEditClass() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("form").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "php/edit_class_form.php", true);
    xhttp.send();
}
function loadEditSession() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("form").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "php/edit_session_form.php", true);
    xhttp.send();
}
