<?php
//echo "<p>".$FirstName."</p><p>".$LastName."</p><p>".$Age."</p><p>".$DegreeId."</p><p>".$Gender;

//http://localhost/myhouse/upload.php?FirstName=Jim&LastName=Mcbeans&Age=314&DegreeId=DoYouEvenMath&Gender=True
$HouseID = $_GET["HouseID"];
$StarValue = $_GET["StarValue"];
$ID = $_GET["ID"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "myhouse";

$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}else{
	echo "sucess connecting";
}
//$d = "Bob";$e = "mac";$a = 23;$b = 32;$c = 0;
$InterestedHouses = NULL;
$statement = $conn->prepare("Select InterestedHouses From Persons where ID = ?");
$statement->bind_param("i",$ID);
$statement->bind_result($InterestedHouses);
$statement->execute();

if $InterestedHouses == NULL and $StarValue == 0 {
	$InterestedHouses = $HouseID;
}
if $StarValue == 0 {
	$InterestedHouses = implode("#",array_diff(explode("#",$InterestedHouses),$HouseID));
} else {
	$InterestedHouses = implode("#",array_push(explode("#",$InterestedHouses),$HouseID));
}
$statement = $conn->prepare("UPDATE Persons Set InterestedHouses = ? WHERE ID = ?");
$statement->bind_param("si",$InterestedHouses,$ID);
$statement->execute();
echo "request sent";
$statement->close();
$conn->close();
# UploadHouse.php?Capacity=100&FilledCapacity=99&Type=PartyHouse&Address=whereever&Postcode=meh&GenderRestriction=0&ContractLength=1&Price=1
?>