var contextPath = document.getElementById("contextPath").value;

function logout() {
    window.location = contextPath + "/logout";
}

function login() {
    window.location = contextPath + "/login";
}
