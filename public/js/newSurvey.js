function toCreateNewSurveyPage() {
    window.location=contextPath + "/surveys/new";
}

function switchReviewInProgress() {
    if (document.getElementById("reviewInProgress").checked)
        document.getElementById("reviewInProgressInput").value="true";
    else
        document.getElementById("reviewInProgressInput").value="false";
}

function validateRespondents() {
    var respondentsArea = document.getElementById("respondents").value;

    if (respondentsArea.length === 0) return false;
    var respondents = respondentsArea.split(/[\s]/).filter(e =>  e);
    if (respondents.length === 0) return false;

    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    for (let i = 0; i < respondents.length; i++) {
        if (!respondents[i].match(emailRegex)) return false;
    }
    return true;
}


function validateForm() {
    var question = document.getElementById("question");
    var dateTimeFrom = document.getElementById("datatime_from");
    var dateTimeTo = document.getElementById("datatime_to");
    var respondents = document.getElementById("respondents");

    var isValid = true

    if (question.value.length === 0) {
        isValid = false;
        document.getElementById("questionRequirement").style.display = "block";
    } else {
        document.getElementById("questionRequirement").style.display = "none";
    }

    if (dateTimeFrom.value.length === 0) {
        isValid = false;
        document.getElementById("datatime_fromRequirement").style.display = "block";
    } else {
        document.getElementById("datatime_fromRequirement").style.display = "none";
    }

    if (dateTimeTo.value.length === 0) {
        isValid = false;
        document.getElementById("datatime_toRequirement").style.display = "block";
    } else {
        document.getElementById("datatime_toRequirement").style.display = "none";
    }

    if (validateRespondents()) {
        document.getElementById("respondentsRequirement").style.display = "none";
    } else {
        isValid = false;
        document.getElementById("respondentsRequirement").style.display = "block";
    }

    if (isValid) {
        document.getElementById("saveVoting").disabled = false;
    } else {
        document.getElementById("saveVoting").disabled = true;
    }
}
