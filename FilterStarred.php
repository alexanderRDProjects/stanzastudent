<?php

//http://localhost/myhouse/basic_search.php?FirstName=Jim&LastName=Mcbeans&Age=314&DegreeId=2&Gender=0
//http://localhost/myhouse/upload.php?FirstName=Jim&LastName=Mcbeans&Age=314&DegreeId=1&Gender=True
$FirstName = $_GET["FirstName"];
$LastName = $_GET["LastName"];
$Age = $_GET["Age"];
//$DegreeId = $_GET["DegreeId"];
//$Gender = $_GET["Gender"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "myhouse";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$InterestedHouses = 0;
$person = $conn->prepare("Select InterestedHouses from Persons where FirstName = ? AND LastName = ?");
//var_dump($person);
$person->bind_param("ss", $FirstName, $LastName);
$person->execute();
$person->bind_result($InterestedHouses);
$person->fetch();
$InterestedHouses = explode("#",$InterestedHouses);
$InterestedHouses = implode(" , ",$InterestedHouses);
$person->close();
$query = "Select * from HOUSE where HouseID in (1,2)";
$result = mysqli_query($conn,$query);
//$Houses = $conn->prepare("Select Capacity from HOUSE where HouseID in (?)");
//$Houses->bind_param("s",$InterestedHouses);
//$Houses->bind_result($notavar);
//$Houses->execute();

//while ($Houses->fetch()){
//	echo $notavar." ";
//}
//$Houses->close();
$conn->close();
echo json_encode(mysqli_fetch_all($result,MYSQLI_ASSOC));

?>