function loadAddLocationForm() {
    var formData = new FormData();
    formData.append("building_name", document.getElementById('building_name').value);
    formData.append("bld_number", document.getElementById('bld_number').value);
    formData.append("street", document.getElementById('street').value);
    formData.append("city", document.getElementById('city').value);
    formData.append("postal_code", document.getElementById('postal_code').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let result = JSON.parse(this.responseText);
            if (result.success) {
                console.log("new location added.");
                alert("New location added.");
            } else {
                console.log("error: unable to add new location.");
                alert("Error: " + result.err);
            }
        }
    };
    xhttp.open("POST", "php/add_location.php", true);
    xhttp.send(formData);
}

function loadAddClassForm() {
    var formData = new FormData();
    formData.append("name", document.getElementById('name').value);
    formData.append("description", document.getElementById('description').value);
    formData.append("enroll_open", document.getElementById('enroll_open').value);
    formData.append("topic", document.getElementById('topic').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let result = JSON.parse(this.responseText);
            if (result.success) {
                console.log("new class added.");
                alert("New class added.");
            } else {
                console.log(result.err);
                alert("Error: " + result.err);
            }
        }
    };
    xhttp.open("POST", "php/add_class.php", true);
    xhttp.send(formData);
}

function loadEditClassForm() {
    var formData = new FormData();
    formData.append("class_id", document.getElementById('class_id').value);
    formData.append("name", document.getElementById('name').value);
    formData.append("description", document.getElementById('description').value);
    formData.append("enroll_open", document.getElementById('enroll_open').value);
    formData.append("topic", document.getElementById('topic').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let result = JSON.parse(this.responseText);
            if (result.success) {
                console.log("class edited.");
                alert("Class edited.");
            } else {
                console.log(result.err);
                alert("Error: " + result.err);
            }
        }
    };
    xhttp.open("POST", "php/edit_class.php", true);
    xhttp.send(formData);
}

function loadAddTopicKnowledgeForm() {
    var formData = new FormData();
    formData.append("topic_id", document.getElementById('topic_id').value);
    formData.append("knowledge_level", document.getElementById('knowledge_level').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let result = JSON.parse(this.responseText);
            if (result.success) {
                console.log("new topic knowledge added.");
                alert("New topic knowledge added.");
            } else {
                console.log(result.err);
                alert("Error: " + result.err);
            }
        }
    };
    xhttp.open("POST", "php/add_topicknow.php", true);
    xhttp.send(formData);
}

function loadAddStudentForm() {
    var formData = new FormData();
    formData.append("dob", document.getElementById('dob').value);
    formData.append("first_name", document.getElementById('first_name').value);
    formData.append("last_name", document.getElementById('last_name').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let result = JSON.parse(this.responseText);
            if (result.success) {
                console.log("Success: student added.");
                alert("Student added.");
            } else {
                console.log(result.err);
                alert("Error: " + result.err);
            }
        }
    };
    xhttp.open("POST", "php/add_student.php", true);
    xhttp.send(formData);
}

function loadEditStudentForm() {
    var formData = new FormData();
    formData.append("student_id", document.getElementById('student_id').value);
    formData.append("dob", document.getElementById('dob').value);
    formData.append("first_name", document.getElementById('first_name').value);
    formData.append("last_name", document.getElementById('last_name').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let result = JSON.parse(this.responseText);
            if (result.success) {
                console.log("Success: student edited.");
                alert("Student edited. ");
            } else {
                console.log(result.err);
                alert("Error: " + result.err);
            }
        }
    };
    xhttp.open("POST", "php/edit_student.php", true);
    xhttp.send(formData);
}

function loadAddTopicForm() {
    var formData = new FormData();
    formData.append("name", document.getElementById('name').value);
    formData.append("description", document.getElementById('description').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let result = JSON.parse(this.responseText);
            if (result.success) {
                console.log("Success: topic added.");
                alert("Topic added.");
            } else {
                console.log(result.err);
                alert("Error: " + result.err);
            }
        }
    };
    xhttp.open("POST", "php/add_topic.php", true);
    xhttp.send(formData);
}

function loadAddSessionForm() {
    var formData = new FormData();
    formData.append("class_id", document.getElementById('class_id').value);
    formData.append("session_num", document.getElementById('session_num').value);
    formData.append("summary", document.getElementById('summary').value);
    formData.append("location_id", document.getElementById('location_id').value);
    formData.append("start_time", document.getElementById('start_time').value);
    formData.append("end_time", document.getElementById('end_time').value);
    formData.append("avail_flag", document.getElementById('avail_flag').value);
    //formData.append("sessitem_flag", document.getElementById('sessitem_flag').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let result = JSON.parse(this.responseText);
            if (result.success) {
                console.log("Success: session added.");
                alert("Session added.");
            } else {
                console.log(result.err);
                alert("Error: " + result.err);
            }
        }
    };
    xhttp.open("POST", "php/add_session.php", true);
    xhttp.send(formData);
}

function loadEditSessionForm() {
    var formData = new FormData();
    formData.append("class_id", document.getElementById('class_id').value);
    formData.append("session_num", document.getElementById('session_num').value);
    formData.append("summary", document.getElementById('summary').value);
    formData.append("location_id", document.getElementById('location_id').value);
    formData.append("start_time", document.getElementById('start_time').value);
    formData.append("end_time", document.getElementById('end_time').value);
    formData.append("avail_flag", document.getElementById('avail_flag').value);
    //formData.append("sessitem_flag", document.getElementById('sessitem_flag').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let result = JSON.parse(this.responseText);
            if (result.success) {
                console.log("Success: session edited.");
                alert("Session edited.");
            } else {
                console.log(result.err);
                alert("Error: " + result.err);
            }
        }
    };
    xhttp.open("POST", "php/edit_session.php", true);
    xhttp.send(formData);
}

function loadEnrollStudentForm() {
    var formData = new FormData();
    formData.append("class_id", document.getElementById('class_id').value);
    formData.append("student_id", document.getElementById('student_id').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let result = JSON.parse(this.responseText);
            if (result.success) {
                console.log("Success: student enrolled.");
                alert("Student enrolled.");
            } else {
                console.log(result.err);
                alert("Error: " + result.err);
            }
        }
    };
    xhttp.open("POST", "php/enroll_student.php", true);
    xhttp.send(formData);
}

function loadAddReviewForm() {
    var formData = new FormData();
    formData.append("tutor_uname", document.getElementById('tutor_uname').value);
    formData.append("comment", document.getElementById('comment').value);
    formData.append("rating", document.getElementById('rating').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let result = JSON.parse(this.responseText);
            if (result.success) {
                console.log("Success: review saved.");
                alert("Review saved. ");
            } else {
                console.log(result.err);
                alert("Error: " + result.err);
            }
        }
    };
    xhttp.open("POST", "php/add_review.php", true);
    xhttp.send(formData);
}

console.log("file loaded");
