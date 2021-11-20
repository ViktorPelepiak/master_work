onload = function () {
    changeValue();
}

function changeValue() {
    if (document.getElementById("answer_yes").checked) {
        document.getElementById("answer").value = "YES";
    } else {
        document.getElementById("answer").value = "NO";
    }
}
