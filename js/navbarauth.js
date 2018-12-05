/*prepend polyfill*/
// Source: https://github.com/jserz/js_piece/blob/master/DOM/ParentNode/prepend()/prepend().md
(function (arr) {
  arr.forEach(function (item) {
    if (item.hasOwnProperty('prepend')) {
      return;
    }
    Object.defineProperty(item, 'prepend', {
      configurable: true,
      enumerable: true,
      writable: true,
      value: function prepend() {
        var argArr = Array.prototype.slice.call(arguments),
          docFrag = document.createDocumentFragment();

        argArr.forEach(function (argItem) {
          var isNode = argItem instanceof Node;
          docFrag.appendChild(isNode ? argItem : document.createTextNode(String(argItem)));
        });

        this.insertBefore(docFrag, this.firstChild);
      }
    });
  });
})([Element.prototype, Document.prototype, DocumentFragment.prototype]);
/*end prepend polyfill*/

function login() {
    var formData = new FormData();
    formData.append("username", document.getElementById('username').value);
    formData.append("pw", document.getElementById('pw').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let x = JSON.parse(this.responseText);
            if(x.status === "Success") {
                showLoggedIn(x.username);
                document.location.assign("logged_in_zone.php");
            } else {
                //todo: don't be annoying..
                alert("Login failed.");
            }
        }
    };
    xhttp.open("POST", "php/auth/login.php", true);
    xhttp.send(formData);
}

function showLoggedIn(uname) {
    document.getElementById("login").innerHTML =
        '<p style="margin-top:10px; float: left;">Hello, ' + uname +
        '</p><button type="button" onclick="logout()" style="float: left; margin: 10px;">Log out</button>';
}

function logout() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let x = JSON.parse(this.responseText);
            if(x.status === "done") {
                document.getElementById("login").innerHTML = 'Logged out. Good-bye. \
                    <button type="button" onclick="showlogin()">Log in</button>';
                signup();
            }
        }
    };
    xhttp.open("POST", "php/auth/logout.php", true);
    xhttp.send();
}

function signup() {
    document.location.assign("signup.html");
}

function showlogin() {
    document.getElementById("login").innerHTML =
        '<div><p>Username</p> <input id="username" type="text" name="username" value="" placeholder="Username" > </div>\
        <div><p>Password</p> <input id="pw" type="password" name="pw" value="" placeholder="Password"> </div>\
        <button type="button" onclick="login()">Log in</button> \
        <button type="button" onclick="signup()">Sign up</button>';
}

function createNavBar(){
    let navbar = document.createElement("nav");
    navbar.setAttribute("id", "navbar");
    navbar.setAttribute("class", "clearfix");
    let bodyRef = document.getElementsByTagName("body")[0]
    bodyRef.prepend(navbar);
    navbar.innerHTML = '<h1 style="float:left; padding-left: 10px;">MinTuro</h1>';

    let loginform=document.createElement("form");
    loginform.setAttribute("id", "login");
    navbar.appendChild(loginform);

    //spacing for first element after nav bar
    let navspacer = document.createElement("div");
    navspacer.setAttribute("id", "navspacer");
    bodyRef.insertBefore(navspacer, navbar.nextElementSibling);

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let x = JSON.parse(this.responseText);
            if(x.status === true) {
                showLoggedIn(x.username);
            } else {
                showlogin();
            }
        }
    };
    xhttp.open("POST", "php/auth/isloggedin.php", true);
    xhttp.send();
}

createNavBar();
