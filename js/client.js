function updateInfoOnPage() {
    setInterval(function () {
        
        var gameID = getGameID();
        if(gameID == "NOT")
            document.getElementById("serwerInfo").innerHTML = "<span class='badge badge-secondary'>BRAK PRZECIWNIKA, CZEKAM</span>";
        else
            document.getElementById("serwerInfo").innerHTML = "<span class='badge badge-primary'>ZNALEZIONO PRZECIWNIKA " + getEnemyID() + "</span>";
        
      }, 2000);
}

function updateGameOnPage() {
    setInterval(function () {
        
        var isYourMove = getIsYourMove();
        if(isYourMove == "YES")
            document.getElementById("gameInfo").innerHTML = "<span class='badge badge-success'>TWOJ RUCH</span>";
        else if (isYourMove == "NO")
            document.getElementById("gameInfo").innerHTML = "<span class='badge badge-danger'>RUCH PRZECIWNIKA</span>";
        else
            document.getElementById("gameInfo").innerHTML = "<span class='badge badge-secondary'>PRZECIWNIK NIE GOTOWY</span>";
        
      }, 1000);
}

function updateOwnTableScreen(){
    setInterval(function () {
        
        var lastMove = getLastMove();
        if(lastMove != "NOT"){
            var splited = lastMove.split("#");
            var x = splited[0];
            var y = splited[1];

            if(!(gameTables[0].rows[x].cells[y].classList.contains("miss") || gameTables[0].rows[x].cells[y].classList.contains("hit"))){
                if(gameTables[0].rows[x].cells[y].classList.contains("placed")){
                    gameTables[0].rows[x].cells[y].classList.toggle("hit");
                    addHitEnemy();
                }
                else
                    gameTables[0].rows[x].cells[y].classList.toggle("miss");
            }
        }
        
      }, 1000);
}