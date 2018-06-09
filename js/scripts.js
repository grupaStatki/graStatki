//document elements handles and timer
var display, gameTables, verifyButton;
var duration = 3;
var timer = duration,
    minutes, seconds;
//
//game tables dimensions    
var height = 10,
    width = 10;
//
//ship placing variables
var placingPhase = true;
var shipSize = 4,
    placedBlocks = 0;
var firstBlockPos = new Array(2);
var lastBlockPos = new Array(2);
//
//ship placement array    
var playerArray = new Array(height);
for (var i = 0; i < height; i++) {
    playerArray[i] = new Array(width).fill(0);
}
//

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


function drawTable() {

    for (var el = 0; el < gameTables.length; el++) {
        for (var i = 0; i < height; i++) {
            var column = gameTables[el].insertRow(i);

            for (var j = 0; j < width; j++) {
                var cell = column.insertCell(j);
                if (el == 0) {
                    cell.id = 'p' + i + j;
                } else {
                    cell.id = 'o' + i + j;
                }
                cell.onclick = function () {
                    tableClick(this);
                }
            }
        }
    }
}

function tableClick(tableCell) {

    if (placingPhase) {
        placeShipBlock(tableCell);
    }
}

function placeShipBlock(tableCell) {
    var x = tableCell.id.substring(1, 2);
    var y = tableCell.id.substring(2, 3);

    if (tableCell.classList != "click" && placedBlocks < shipSize) {
        tableCell.classList.toggle("click");
        if(placedBlocks==0)
            firstBlockPos=[y,x];
        playerArray[x][y] = shipSize;
        placedBlocks += 1;
        if(placedBlocks==shipSize)
            lastBlockPos=[y,x];
        
    } else if (tableCell.classList == "click") {
        tableCell.classList.toggle("click");
        playerArray[x][y] = 0;
        placedBlocks -= 1;
    }
    if (placedBlocks == shipSize) {
        verifyButton.disabled = false;
    } else {
        verifyButton.disabled = true;
    }
}

function verifyShip() {
    console.log(playerArray);
    console.log(firstBlockPos);
    console.log(lastBlockPos);
    console.log(playerArray[lastBlockPos[1]][lastBlockPos[0]]);

    var count=0;
    if(firstBlockPos[1]==lastBlockPos[1]){
        for(var i=0; i<width;i++){
            if(playerArray[firstBlockPos[1]][i] == shipSize){
                count+=1;
                if(count==shipSize)
                    break;
            }else{
                count=0;
            }
        }
        if(count==shipSize){
            alert(count);
        }else{
            alert("Złe rozmieszczenie bloków!");
        }
    }else if(firstBlockPos[0]==lastBlockPos[0]){
        for(var i=0; i<height;i++){
            if(playerArray[i][firstBlockPos[0]] == shipSize){
                count+=1;
                if(count==shipSize)
                break;
            }else{
                count=0;
            }
        }
        if(count==shipSize){
            alert(count);
        }else{
            alert("Złe rozmieszczenie bloków!");
        }
    }else
        alert("Złe rozmieszczenie bloków!");
}


//gameTables[0].rows[firstBlockPos[1]].cells[i].classList=="click"







window.onload = function () {
    gameTables = document.getElementsByName("gameArea");
    display = document.querySelector('#time');
    drawTable();
    startTimer();
    verifyButton = document.getElementById("verifyButton");
    verifyButton.disabled = true;
    //this.alert("Witaj! Na początek ustawimy statki.\n Zacznij od 4-masztowca, gdy będziesz gotowy kliknij Verify Ship!");
};