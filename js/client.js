function updateInfoOnPage() {
    setInterval(function () {
        
        var gameID = getGameID();
        if(gameID == "NOT")
            document.getElementById("serwerInfo").innerHTML = "BRAK PRZECIWNIKA<BR>CZEKAM";
        else
            document.getElementById("serwerInfo").innerHTML = "ZNALEZIONO PRZECIWNIKA";
        
      }, 1000);
}