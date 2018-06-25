var gameID;
var isYourMove;
var enemyID

function sendTable(playerID, playerArray) {
	var stringArray = playerArray.toString();
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      
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
      var value = "<span class='badge badge-secondary'>DOŁĄCZONO DO SERWERA</span>";
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
      var value = "Opuszczono serwer";
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

function getEnemyID(){
  var tmp = gameID.split('#And#');

  if(tmp[0]==playerID)
    enemyID = tmp[1];
  else
    enemyID = tmp[0];

  return enemyID;
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
    xhttp.open("POST", "http://localhost/statkiSerwer/whoseMove.php", false);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send("playerID='" + playerID + "'&gameID='" + gameID + "'");
  }, 1000);

  updateGameOnPage();
}

function fireToEnemy(x,y){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText==""){
        document.getElementById("myAlert").innerHTML = "PUDŁO";
        gameTables[1].rows[x].cells[y].classList.toggle("miss");
      }
      else{
        document.getElementById("myAlert").innerHTML = this.responseText;
        gameTables[1].rows[x].cells[y].classList.toggle("hit");
      }

      document.getElementById("myAlert").style.visibility = "visible";
      setTimeout(function() { document.getElementById("myAlert").style.visibility = "hidden"; }, 2000);
    }
  };
  xhttp.open("POST", "http://localhost/statkiSerwer/fireToEnemy.php", true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send("playerID='" + getEnemyID() + "'&x=" + x + "&y=" + y + "&gameID='" + gameID + "'");
}

function setPlayerReady(playerID, value) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      
    }
  };
  xhttp.open("POST", "http://localhost/statkiSerwer/index.php", false);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send("playerID='" + playerID + "'&isReady='" + value + "'");
}