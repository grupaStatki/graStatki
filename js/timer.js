var display;
var duration = 3;
var timer = duration, minutes, seconds;

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

window.onload = function () {
    display = document.querySelector('#time');
	startTimer();
};

function resetTimer() {
    duration = 3;
	timer = duration, minutes, seconds;
}