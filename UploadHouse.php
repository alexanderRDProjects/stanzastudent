<?php
//echo "<p>".$FirstName."</p><p>".$LastName."</p><p>".$Age."</p><p>".$DegreeId."</p><p>".$Gender;

//http://localhost/myhouse/upload.php?FirstName=Jim&LastName=Mcbeans&Age=314&DegreeId=DoYouEvenMath&Gender=True
$Capacity = $_GET["Capacity"];
$FilledCapacity = $_GET["FilledCapacity"];
$Type = $_GET["Type"];
$Address = $_GET["Address"];
$Postcode = $_GET["Postcode"];
$Price = $_GET["Price"];
$GenderRestriction = $_GET["GenderRestriction"];
$ContractLength = $_GET["ContractLength"];
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
$statement = $conn->prepare("INSERT INTO House (Capacity,FilledCapacity,Type,Address,Postcode,Price,GenderRestriction,ContractLength) VALUES (?,?,?,?,?,?,?,?)");
$statement->bind_param("iisssiii",$Capacity,$FilledCapacity,$Type,$Address,$Postcode,$Price,$GenderRestriction,$ContractLength);
$statement->execute();


echo "request sent";
$statement->close();
$conn->close();
# UploadHouse.php?Capacity=100&FilledCapacity=99&Type=PartyHouse&Address=whereever&Postcode=meh&GenderRestriction=0&ContractLength=1&Price=1
?>