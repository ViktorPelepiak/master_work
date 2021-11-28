onload = function () {
    addValidationForPasswords();
    document.getElementById("search").addEventListener("input", function (event) {
        search();
    });
}

function enable(id) {
    $.ajax({
        url: contextPath + "/admin/user/enable/" + id,
        type: "post",
    }).done(function (data) {
        document.getElementById("admin_disable_" + id).style.display = "";
        document.getElementById("admin_enable_" + id).style.display = "none";
        document.getElementById("is_enable_" + id).checked = true;
    });
}

function disable(id) {
    $.ajax({
        url: contextPath + "/admin/user/disable/" + id,
        type: "post",
    }).done(function (data) {
        document.getElementById("admin_disable_" + id).style.display = "none";
        document.getElementById("admin_enable_" + id).style.display = "";
        document.getElementById("is_enable_" + id).checked = false;
    });
}

function deleteAdminById(id) {
    $.ajax({
        url: contextPath + "/admin/user/delete/" + id,
        type: "post",
    }).done(function (data) {
        document.location.reload();
    });
}

function addValidationForPasswords(){
    var password = document.getElementById("password");
    var passwordConfirm = document.getElementById("confirm_password");

    var handler = function (event) {
        if (password.value.length > 0 && passwordConfirm.value.length> 0) {
            console.log("check");
            if (password.value===passwordConfirm.value) {
                password.setCustomValidity("");
                passwordConfirm.setCustomValidity("");
            } else {
                password.setCustomValidity("Пароль і його підтвердження є різними");
                passwordConfirm.setCustomValidity("Пароль і його підтвердження є різними");
            }
        }
    }

    password.addEventListener("input", handler);

    passwordConfirm.addEventListener("input", handler);
}

function search() {
    var rows = document.getElementsByName("admin_row");
    var searchValue = document.getElementById("search").value;

    var validRows = 0;

    for (let i = 0; i < rows.length; i++) {
        rows[i].style.display = "";
        if (rows[i].children[0].innerText.includes(searchValue)){
            validRows++;
        } else {
            rows[i].style.display = "none";
        }
    }
}
