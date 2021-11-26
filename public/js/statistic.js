var answers;

onload = function () {
    answers = document.getElementById("answerVariantsInput").value.split(",");
    displayAnswerContainer();
    drawChart();
}

function displayAnswerContainer() {
    var answersContainer = document.getElementById("answerVariants");
    document.getElementById("answerVariants").value = answers;

    answersContainer.innerHTML = "";

    for (let i = 0; i < answers.length; i++) {
        if (answers[i] !== "Не проголосувало"){
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
        }
    }
}

function drawChart() {
    if (document.getElementById("chartContainer")) {

        var answerVariants = document.getElementById("answerVariantsArray").value.split(",");
        var answerVariantsNum = document.getElementById("answerQuantities").value.split(",").map(number => parseInt(number));

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Результати голосування"
            },
            data: [{
                type: "pie",
                startAngle: 270,
                yValueFormatString: "##0",
                indexLabel: "{label} {y}",
                dataPoints: answerVariants.map((label, index) => ({ label, y: answerVariantsNum[index] }))
            }]
        });
        chart.render();
    }
}

