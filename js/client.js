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