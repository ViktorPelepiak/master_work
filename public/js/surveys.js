function deleteSurveyById(id) {
    console.log("deleteById->" + id);
    $.ajax({
        url: contextPath + "/survey/delete/" + id,
        type: "post",
    })

    // window.location.href = contextPath + "/private";
    window.location.refresh();
}

function surveyReview(id) {
    window.location.href = contextPath + "/survey/review/" + id;
}
