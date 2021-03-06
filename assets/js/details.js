var tempCounter = 0;
var soundCounter = 0;
var tempCtx;
var soundCtx;
var tempChart;
var soundChart;

function drawTemp() {
    tempCounter++;
    tempCtx = document.getElementById("temp-chart-long").getContext('2d');

    // console.log((tempCounter = tempCounter % 2));
    if ((tempCounter = tempCounter % 2) == 0) {
        tempChart.destroy();
        document.getElementById("temp-btn").style.backgroundColor = "#465a3f";
    } else {
        document.getElementById("temp-btn").style.backgroundColor = "#798d6f";
        tempChart = new Chart(tempCtx, {
            type: 'line',
            data: {
                labels: temperatureX,
                datasets: [{
                    label: 'Temperature Readings',
                    data: temperatureData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                responsive: true
            }
        });
    }
}


function drawSound() {
    soundCounter++;
    soundCtx = document.getElementById("sound-chart-long").getContext('2d');

    // console.log((soundCounter = soundCounter % 2));
    if ((soundCounter = soundCounter % 2) == 0) {
        soundChart.destroy();
        document.getElementById("sound-btn").style.backgroundColor = "#465a3f";
    } else {
        document.getElementById("sound-btn").style.backgroundColor = "#798d6f";
        soundChart = new Chart(soundCtx, {
            type: 'line',
            data: {
                labels: audioX,
                datasets: [{
                    label: 'Audio Readings',
                    data: audioData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                responsive: true
            }
        });
    }
}
