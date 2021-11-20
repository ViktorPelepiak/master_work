onload = function () {
    drawChart();
}

function drawChart() {
    if (document.getElementById("chartContainer")) {

        var agree = parseInt(document.getElementById("agreeQuantity").value);
        var disagree = parseInt(document.getElementById("disagreeQuantity").value);
        var notVoted = parseInt(document.getElementById("notVotedQuantity").value);

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
                dataPoints: [
                    {y: agree, label: "За"},
                    {y: disagree, label: "Проти"},
                    {y: notVoted, label: "Не проголосували"}
                ]
            }]
        });
        chart.render();
    }
}

