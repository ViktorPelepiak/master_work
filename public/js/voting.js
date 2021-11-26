onload = function () {
    displayAnswerVariants();
}

function changeValue(index) {
    document.getElementById("answer").value = "" + index;
    document.getElementById("voteBtn").disabled = false;
}

function displayAnswerVariants() {
    var answersContainer = document.getElementById("answerVariants");
    var answers = document.getElementById("answerVariantList").value.split(",");

    answersContainer.innerHTML = "";

    for (let i = 0; i < answers.length; i++) {
        var answerVariantContainer = document.createElement("div");
        answerVariantContainer.classList.add("answer-variant-container");
        answerVariantContainer.id = "answerVariantContainer" + i;
        answersContainer.appendChild(answerVariantContainer);

        var radio = document.createElement("input");
        radio.id = "answer" + i;
        radio.name = "answerVariantRadioGroup"
        radio.type = "radio";
        radio.value = "" + i;
        radio.classList.add("form-check");
        radio.classList.add("answer-radio");
        radio.onclick = function (){changeValue(i)};
        answerVariantContainer.appendChild(radio);

        var answerVariantLabel = document.createElement("label");
        answerVariantLabel.classList.add("answer-label");
        answerVariantLabel.setAttribute("for", "answer" + i);
        answerVariantLabel.innerText = answers[i];
        answerVariantContainer.appendChild(answerVariantLabel);
    }
}
