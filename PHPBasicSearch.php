<?php

//http://localhost/myhouse/basic_search.php?FirstName=Jim&LastName=Mcbeans&Age=314&DegreeId=2&Gender=0
//http://localhost/myhouse/upload.php?FirstName=Jim&LastName=Mcbeans&Age=314&DegreeId=1&Gender=True
$FirstName = $_GET["FirstName"];
$LastName = $_GET["LastName"];
$Age = $_GET["Age"];
$DegreeId = $_GET["DegreeId"];
$Gender = $_GET["Gender"];
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

$PersonSql = "SELECT * from Persons";
$Persons = $conn->query($PersonSql);
$HouseSql = "SELECT * FROM House";
$House = $conn->query($HouseSql);

//var_dump($Persons->fetch_assoc());
//var_dump($House);
$PersonData = [];
while($row = $Persons->fetch_assoc()) {
	array_push($PersonData,$row);
}

$HouseData = [];
while($row = $House->fetch_assoc()) {
	array_push($HouseData,$row);
}
//var_dump($PersonData);
//var_dump($HouseData);

//foreach ($PersonData as &$instance){
//	$current_person_score = 0;
//	if ($instance->Age != $Age){
//		$current_person_score += abs($instance->Age-$Age);
//	}
//}

$house_score = [];
foreach ($HouseData as &$HouseInst){
	//echo "here";
	//var_dump($HouseInst);
	$CurrentHouseScore = [$HouseInst,0];
	$counter = 0;
	foreach ($PersonData as &$PersonInst) {
		
		if ($PersonInst['HouseID'] == $HouseInst['HouseID']){
			//search and rating goes here
			$CurrentHouseScore[1] += SearchWeighting($PersonInst["Age"],$Age,NULL,NULL,$PersonInst["Gender"],$Gender,NULL,NULL,NULL,NULL,NULL,NULL);
			
		}
	}
	if ($counter != 0){
		$CurrentHouseScore[1] = $CurrentHouseScore[1]/$counter;
	}
	array_push($house_score,$CurrentHouseScore);
}


usort($house_score, "my_sort");

function my_sort($a2, $b2)
{
	$a = $a2[1];
	$b = $b2[1];
	
	if($a == $b)
		return 0;
	
	if($a < $b)
		return -1;
	else
		return 1;
}

$houses = array_map("my_trim", $house_score);

function my_trim($a)
{
	return $a[0];
}

echo json_encode($houses);




// sort function

function SearchWeighting($TargetAge, $Age, $TargetDegree, $Degree, $TargetCleanliness, $Cleanliness, $TargetSocialFactor, $SocialFactor, $TargetYearOfStudy, $YearOfStudy){
$Search_Weight = 0;

//Check
/*if($Gender != $TargetGender && $TargetGender != NULL){
$Search_Weight += 50
}*/

//Check ages and update weighting
$AgeCheck = abs($Age - $TargetAge);

switch (true) {
    case ($AgeCheck = 0):
        break;
    case (0 < $AgeCheck && $AgeCheck <= 2):
        $Search_Weight += 1;
        break;
    case (2 < $AgeCheck && $AgeCheck <= 4):
        $Search_Weight += 2;
        break;
    case (4 < $AgeCheck && $AgeCheck <= 8):
        $Search_Weight += 3;
        break;
    default:
        $Search_Weight += 5;

//Checks degree course
if($Degree != $TargetDegree){
  $Search_Weight += 3;
}

//Checks difference in year of study
$Search_Weight += abs($YearOfStudy - $TargetYearOfStudy)*2;

//Checks difference in cleanliness and drinking habits
$Search_Weight += abs($Cleanliness - $TargetCleanliness);
$Search_Weight += abs($SocialFactor - $TargetSocialFactor);
}}

?>