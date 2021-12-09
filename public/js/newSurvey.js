var answers = ['Погоджуюся', 'Не погоджуюся'];

window.onload = function () {
    displayAnswerContainer();
}

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

function displayAnswerContainer() {
    var answersContainer = document.getElementById("answerVariants");
    document.getElementById("answerVariantList").value = answers;

    answersContainer.innerHTML = "";

    for (let i = 0; i < answers.length; i++) {
        var answerVariantContainer = document.createElement("div");
        answerVariantContainer.classList.add("answer-variant-container");
        answerVariantContainer.id = "answerVariantContainer" + i;
        answersContainer.appendChild(answerVariantContainer);

        var fakeRadio = document.createElement("input");
        fakeRadio.type = "radio";
        fakeRadio.disabled = true;
        fakeRadio.classList.add("form-check");
        fakeRadio.classList.add("fake-radio");
        answerVariantContainer.appendChild(fakeRadio);

        var answerVariantInput = document.createElement("input");
        answerVariantInput.type = "text";
        answerVariantInput.disabled = true;
        answerVariantInput.classList.add("form-control");
        answerVariantInput.classList.add("answer-variant");
        answerVariantInput.value = answers[i];
        answerVariantContainer.appendChild(answerVariantInput);

        var editAnswerVariantBtn = document.createElement("button");
        editAnswerVariantBtn.type = "button";
        editAnswerVariantBtn.classList.add("btn");
        editAnswerVariantBtn.classList.add("btn-primary");
        editAnswerVariantBtn.classList.add("btn-edit-answer-variant");
        editAnswerVariantBtn.onclick = function () {prepareEditAnswerVariantModal(i)};
        editAnswerVariantBtn.innerText = "Редагувати";
        editAnswerVariantBtn.setAttribute("data-toggle", "modal");
        editAnswerVariantBtn.setAttribute("data-target", "#editAnswerModal");
        answerVariantContainer.appendChild(editAnswerVariantBtn);

        var deleteAnswerVariantBtn = document.createElement("button");
        deleteAnswerVariantBtn.classList.add("btn");
        deleteAnswerVariantBtn.classList.add("btn-danger");
        deleteAnswerVariantBtn.classList.add("btn-remove-answer-variant");
        deleteAnswerVariantBtn.onclick = function () {deleteAnswerVariant(i)};
        deleteAnswerVariantBtn.innerText = "Видалити";
        if (answers.length > 2) {
            deleteAnswerVariantBtn.disabled = false;
        } else {
            deleteAnswerVariantBtn.disabled = true;
        }
        answerVariantContainer.appendChild(deleteAnswerVariantBtn);
    }
}

function deleteAnswerVariant(index) {
    answers.splice(index, 1);
    displayAnswerContainer();

    document.getElementById("addAnswerVariant").disabled = false;
}

function prepareAddAnswerVariantModal() {
    var newAnswerVariantInput = document.getElementById("newAnswerVariantInput");
    newAnswerVariantInput.value = "";
    newAnswerVariantInput.focus();
}

function addAnswerVariant() {
    var newAnswerVariant = document.getElementById("newAnswerVariantInput").value;
    if (newAnswerVariant.length > 0){
        answers.push(newAnswerVariant);
        displayAnswerContainer();
    }
    if (answers.length  === 10) {
        document.getElementById("addAnswerVariant").disabled = true;
    }
}

function prepareEditAnswerVariantModal(index) {
    document.getElementById("index").value = index;
    var editAnswerVariantInput = document.getElementById("editAnswerVariantInput");
    editAnswerVariantInput.value = answers[index];
    editAnswerVariantInput.focus();
}

function editAnswerVariant() {
    var index = parseInt(document.getElementById("index").value);
    var newAnswer = document.getElementById("editAnswerVariantInput").value;

    if (newAnswer.length > 0) {
        answers.splice(index, 1, newAnswer);
        displayAnswerContainer();
    }
}
