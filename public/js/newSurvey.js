function toCreateNewSurveyPage() {
    window.location=contextPath + "/surveys/new";
}

function switchReviewInProgress() {
    if (document.getElementById("reviewInProgress").checked)
        document.getElementById("reviewInProgressInput").value="true";
    else
        document.getElementById("reviewInProgressInput").value="false";
}
