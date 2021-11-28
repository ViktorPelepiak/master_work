function deleteSurveyById(id) {
    console.log("deleteById->" + id);
    $.ajax({
        url: contextPath + "/survey/delete/" + id,
        type: "post",
    }).done(function (data) {
        document.location.reload();
    });
}

function surveyReview(id) {
    window.location.href = contextPath + "/survey/review/" + id;
}
