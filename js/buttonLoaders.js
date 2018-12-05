
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
