var gameID;
var isYourMove;

function sendTable(playerID, playerArray) {
	var stringArray = playerArray.toString();
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      alert(this.responseText);
    }
  };
  xhttp.open("POST", "http://localhost/statkiSerwer/insertAndUpdate.php", true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send("playerID='" + playerID + "'&gameArray='" + stringArray + "'");
}

function joinWaitingRoom(playerID) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var value = "<br>Dołączono do serwera";
      document.getElementById("serwerInfo").innerHTML = value;
    }
  };
  xhttp.open("POST", "http://localhost/statkiSerwer/joinWaitingRoom.php", true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send("playerID='" + playerID + "'");
}

function leaveWaitingRoom(playerID) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var value = "<br>Opuszczono serwer";
      document.getElementById("serwerInfo").innerHTML = value;
    }
  };
  xhttp.open("POST", "http://localhost/statkiSerwer/leaveWaitingRoom.php", false);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send("playerID='" + playerID + "'&gameID='" + gameID + "'");
}

function requestForOpponent(playerID){

  setInterval(function () {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        gameID = this.responseText;
      }
    };
    xhttp.open("POST", "http://localhost/statkiSerwer/gameRoomUpdater.php", false);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send("playerID='" + playerID + "'");
  }, 2000);

  updateInfoOnPage();
}

function getGameID(){
  return gameID;
}

function getIsYourMove(){
  return isYourMove;
}

function whoseMoveListener(playerID, gameID){

  var gameID = getGameID();
  setInterval(function () {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        isYourMove = this.responseText;
      }
    };
    xhttp.open("POST", "http://localhost/statkiSerwer/index.php", false);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send("playerID='" + playerID + "'&gameID='" + gameID + "'");
  }, 1000);

  updateGameOnPage();
}