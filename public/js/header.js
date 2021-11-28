var contextPath = document.getElementById("contextPath").value;

function logout() {
    window.location = contextPath + "/logout";
}

function login() {
    window.location = contextPath + "/login";
}

function mySurveys() {
    window.location = contextPath + "/private";
}

function userManagement() {
    window.location = contextPath + "/admin/users";
}
