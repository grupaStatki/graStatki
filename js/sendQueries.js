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