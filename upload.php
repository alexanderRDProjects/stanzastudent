<?php
//echo "<p>".$FirstName."</p><p>".$LastName."</p><p>".$Age."</p><p>".$DegreeId."</p><p>".$Gender;

//http://localhost/myhouse/upload.php?FirstName=Jim&LastName=Mcbeans&Age=314&DegreeId=DoYouEvenMath&Gender=True
$FirstName = $_GET["FirstName"];
$LastName = $_GET["LastName"];
$Age = $_GET["Age"];
$DegreeId = $_GET["DegreeId"];
$Gender = $_GET["Gender"];
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
$statement = $conn->prepare("INSERT INTO Persons (FirstName,LastName,Age,DegreeId,Gender) VALUES (?,?,?,?,?)");
$statement->bind_param("ssiii",$FirstName,$LastName,$Age,$DegreeId,$Gender);
$statement->execute();


echo "request sent";
$statement->close();
$conn->close();
?>