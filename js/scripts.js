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
var placingPhase = true,
    dirHorizontal = true; // true - horizontal, false - vertical
var shipSize = 4,
    placedBlocks = 0;
var firstBlockPos = new Array(2),
    lastBlockPos = new Array(2),
    foundFirstBlock = new Array(2),
    foundLastBlock = new Array(2);
var shipsQuantity = [4, 3, 2, 1];
//
//ship placement array    
var shipPlacingArray = new Array(height);
for (var i = 0; i < height; i++) {
    shipPlacingArray[i] = new Array(width).fill(0);
}
var playerArray = new Array(height);
for (var i = 0; i < height; i++) {
    playerArray[i] = new Array(width).fill(0);
}
//
var userID;

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
    } else {
        alert("koniec fazy");
    }
}

function placeShipBlock(tableCell) {
    var x = tableCell.id.substring(1, 2);
    var y = tableCell.id.substring(2, 3);

    if (tableCell.classList != "click" && placedBlocks < shipSize) {
        tableCell.classList.toggle("click");
        if (placedBlocks == 0)
            firstBlockPos = [y, x];
        shipPlacingArray[x][y] = shipSize;
        placedBlocks += 1;
        if (placedBlocks == shipSize)
            lastBlockPos = [y, x];

    } else if (tableCell.classList == "click") {
        tableCell.classList.toggle("click");
        shipPlacingArray[x][y] = 0;
        placedBlocks -= 1;
    }
    if (placedBlocks == shipSize) {
        verifyButton.disabled = false;
    } else {
        verifyButton.disabled = true;
    }
}

function verifyShip() {

    var count = 0;
    if (firstBlockPos[1] == lastBlockPos[1]) {
        for (var i = 0; i < width; i++) {
            if (shipPlacingArray[firstBlockPos[1]][i] == shipSize) {
                if (count == 0) {
                    foundFirstBlock = [i, firstBlockPos[1]];
                }
                count += 1;
                if (count == shipSize) {
                    foundLastBlock = [i, firstBlockPos[1]];
                    dirHorizontal = true;
                    break;
                }
            } else {
                count = 0;
            }
        }
        if (count == shipSize) {
            addShipToTable();
        } else {
            alert("Złe rozmieszczenie bloków!");
        }
    } else if (firstBlockPos[0] == lastBlockPos[0]) {
        for (var i = 0; i < height; i++) {
            if (shipPlacingArray[i][firstBlockPos[0]] == shipSize) {
                if (count == 0) {
                    foundFirstBlock = [firstBlockPos[0], i];
                }
                count += 1;
                if (count == shipSize) {
                    foundLastBlock = [firstBlockPos[0], i];
                    dirHorizontal = false;
                    break;
                }
            } else {
                count = 0;
            }
        }
        if (count == shipSize) {
            addShipToTable();
        } else {
            alert("Złe rozmieszczenie bloków!");
        }
    } else
        alert("Złe rozmieszczenie bloków!");
}

function addShipToTable() {
    if (dirHorizontal) {
        for (var i = foundFirstBlock[0]; i <= foundLastBlock[0]; i++) {
            playerArray[foundFirstBlock[1]][i] = shipSize;
            gameTables[0].rows[foundFirstBlock[1]].cells[i].classList.toggle("placed");
            gameTables[0].rows[foundFirstBlock[1]].cells[i].onclick = null;
        }

        for (var i = foundFirstBlock[0] - 1; i <= foundLastBlock[0] + 1; i++) {
            if (i < 0)
                i = 0;
            for (var j = parseInt(foundFirstBlock[1]) - 1; j <= parseInt(foundLastBlock[1]) + 1; j++) {
                if (j < 0)
                    j = 0;
                if (i < 10 && j < 10) {
                    if (playerArray[j][i] == 0) {
                        playerArray[j][i] = 9;
                        gameTables[0].rows[j].cells[i].classList.toggle("blocked");
                        gameTables[0].rows[j].cells[i].onclick = null;
                    }
                }
            }

        }
    } else {
        for (var i = foundFirstBlock[1]; i <= foundLastBlock[1]; i++) {
            playerArray[i][foundFirstBlock[0]] = shipSize;
            gameTables[0].rows[i].cells[foundFirstBlock[0]].classList.toggle("placed");
            gameTables[0].rows[i].cells[foundFirstBlock[0]].onclick = null;
        }

        for (var i = foundFirstBlock[1] - 1; i <= foundLastBlock[1] + 1; i++) {
            if (i < 0)
                i = 0;
            for (var j = parseInt(foundFirstBlock[0]) - 1; j <= parseInt(foundLastBlock[0]) + 1; j++) {
                if (j < 0)
                    j = 0;
                if (i < 10 && j < 10) {
                    if (playerArray[i][j] == 0) {
                        playerArray[i][j] = 9;
                        gameTables[0].rows[i].cells[j].classList.toggle("blocked");
                        gameTables[0].rows[i].cells[j].onclick = null;
                    }
                }
            }
        }
    }

    for (var i = 0; i < height; i++) {
        shipPlacingArray[i] = new Array(width).fill(0);
    }

    firstBlockPos.fill(0);
    lastBlockPos.fill(0);
    placedBlocks = 0;
    shipsQuantity[shipSize - 1] -= 1;
    if (shipsQuantity[shipSize - 1] == 0) {
        if (shipSize > 1) {
            shipSize -= 1;
        } else {
            placingPhase = false;
        }
    }
    verifyButton.disabled = true;
}

function placingPhaseListener() {
    if(placingPhase == true) {
        setTimeout(placingPhaseListener, 50);
        return;
    }
    alert("SKONCZONO");
    sendTable(userID, playerArray);
}

window.addEventListener("beforeunload", function(event) {
    leaveWaitingRoom(userID);
});

window.onload = function () {
    userID = checkCookie();
    joinWaitingRoom(userID);
	placingPhaseListener();
    gameTables = document.getElementsByName("gameArea");
    display = document.querySelector('#time');
    drawTable();
    startTimer();
    verifyButton = document.getElementById("verifyButton");
    verifyButton.disabled = true;
    //this.alert("Witaj! Na początek ustawimy statki.\n Zacznij od 4-masztowca, gdy będziesz gotowy kliknij Verify Ship!");
};