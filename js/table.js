var height = 10;
var width = 10;
var t ;
function drawTable(){

    for(var el=0;el<t.length; el++){
        for(var i=0;i<height;i++){
            var column = t[el].insertRow(i);

            for(var j=0;j<width;j++){
                column.insertCell(j);
            }
        }
    }
}

window.onload = function () {
    t = document.getElementsByName("gameArea")
	drawTable();
};