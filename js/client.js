function updateInfoOnPage() {
    setInterval(function () {
        
        var gameID = getGameID();
        if(gameID == "NOT")
            document.getElementById("serwerInfo").innerHTML = "BRAK PRZECIWNIKA<BR>CZEKAM";
        else
            document.getElementById("serwerInfo").innerHTML = "ZNALEZIONO PRZECIWNIKA";
        
      }, 2000);
}

function updateGameOnPage() {
    setInterval(function () {
        
        var isYourMove = getIsYourMove();
        if(isYourMove == "YES")
            document.getElementById("gameInfo").innerHTML = "TWOJ RUCH";
        else
            document.getElementById("gameInfo").innerHTML = "RUCH PRZECIWNIKA";
        
      }, 1000);
}