var display;
var duration = 3;
var timer = duration, minutes, seconds;
var height = 10;
var width = 10;
var t;


function startTimer() {

    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            display.textContent = "END";
        }
    }, 1000);
	
	
}

function resetTimer() {
    duration = 3;
	timer = duration, minutes, seconds;
}


function drawTable(){

    for(var el=0;el<t.length; el++){
        for(var i=0;i<height;i++){
            var column = t[el].insertRow(i);

            for(var j=0;j<width;j++){
                var cell = column.insertCell(j);
                cell.onclick = function () {
                    tableClick(this);
                }
            }
        }
    }
}

function tableClick(tableCell){
    tableCell.classList.toggle("click");
}


window.onload = function () {
    t = document.getElementsByName("gameArea");
    display = document.querySelector('#time');
    drawTable();
    startTimer();
};