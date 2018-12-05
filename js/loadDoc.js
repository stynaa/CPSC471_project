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
            if (this.responseText=="SUCCESS") {
                console.log("new location added.");
            } else {
                console.log("error: unable to add new location.");
            }
        }
    };
    xhttp.open("POST", "../php/add_location.php", true);
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
            } else {
                console.log(result.err);
            }
        }
    };
    xhttp.open("POST", "../php/add_class.php", true);
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
            } else {
                console.log(result.err);
            }
        }
    };
    xhttp.open("POST", "../php/add_topicknow.php", true);
    xhttp.send(formData);
}