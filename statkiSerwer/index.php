<?php

function checkIsDestroyed($indeks, $array){
    if($indeks==404)
        return true;
    else if($array[$indeks]==9)
        return true;
}

function checkArrayPionIndex($indeks, $margin){
    if($indeks-$margin<0 || $indeks-$margin>99)
        return 404;
    else 
        return $indeks-$margin;
}

function checkSomsiad($indeks, $array){
    if($indeks==404)
        return 0;
    else if($array[$indeks]==4 || $array[$indeks]==3 || $array[$indeks]==2)
        return 1;
}

function checkArrayPoziomIndex($indeks, $margin){
    if($indeks-$margin<0 || $indeks-$margin>99)
        return 404;
    else if($indeks%10 == 0 || $indeks%10==9)
        return 404;
    else
        return $indeks-$margin;
}

function checkDestroyedOneSize($exploded, $indeks){
    if($exploded[$indeks]!=0 && $exploded[$indeks]!=9){
        if(checkIsDestroyed(checkArrayPionIndex($indeks,-10), $exploded)){
            if(checkIsDestroyed(checkArrayPionIndex($indeks,10), $exploded)){
                if(checkIsDestroyed(checkArrayPoziomIndex($indeks,-1), $exploded)){
                        if(checkIsDestroyed(checkArrayPoziomIndex($indeks,1), $exploded)){
                            echo "ZNISZCZONY";
                            return true;
                        }
                    }
                }
            }
        }

    return false;
}

function check8($indeks, $array){
    if($indeks==404)
        return $array;
    if($array[$indeks]==8){
        $array[$indeks]=9;
    }
    return $array;
}

function remove8($exploded, $indeks){
    $exploded = check8(checkArrayPionIndex($indeks,-10), $exploded);
    $exploded = check8(checkArrayPionIndex($indeks, 10), $exploded);
    $exploded = check8(checkArrayPoziomIndex($indeks, -1), $exploded);
    $exploded = check8(checkArrayPoziomIndex($indeks, 1), $exploded);

    return $exploded;
}

function checkIsHitedLargeShip($exploded, $indeks){
    if($exploded[$indeks]!=0 && $exploded[$indeks]!=9 && $exploded[$indeks]!=1){
        $exploded = remove8($exploded, $indeks);
        $counter = 0;
        $counter = $counter + checkSomsiad(checkArrayPionIndex($indeks,-10), $exploded);
        $counter = $counter + checkSomsiad(checkArrayPionIndex($indeks, 10), $exploded);
        $counter = $counter + checkSomsiad(checkArrayPoziomIndex($indeks, -1), $exploded);
        $counter = $counter + checkSomsiad(checkArrayPoziomIndex($indeks, 1), $exploded);

        if($counter==1 || $counter==0){
            $exploded[$indeks] = 9;
            echo "HIT 9";
        }
        if($counter==2){
            $exploded[$indeks] = 8;
            echo "HIT 8";
        }
    }

    return $exploded;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "statki";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$playerID = $_POST["playerID"];
$x = $_POST["x"];
$y = $_POST["y"];
$sql = "SELECT gameArray FROM playersarrays where playerID = " . $playerID;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $gameArray = $row["gameArray"];
    }
} else {
    echo "ERRR";
}
$indeks = 10*$x+$y;
$exploded = explode(',',$gameArray);
//echo $exploded[];
if(checkDestroyedOneSize($exploded, $indeks))
    $exploded[$indeks] = 9;
else
    $exploded = checkIsHitedLargeShip($exploded, $indeks);


$rawArray=implode(',',$exploded);

$sql = "UPDATE playersarrays SET gameArray = '" . $rawArray . "' WHERE playerID = " . $playerID ;

if ($conn->query($sql) === TRUE) {

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>