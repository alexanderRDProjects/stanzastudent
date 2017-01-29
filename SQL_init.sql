
DROP TABLE Persons;
CREATE TABLE Persons
(
ID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (ID), 
FirstName varchar(255),
LastName varchar(255),
Age int,
HasHome boolean,
HouseID int,
GroupID int,
Hobbies varchar(128),
DegreeID int,
YearOfStudy varchar(2),
Description varchar(2048),
Gender boolean,
Cleanliness int,
SocialFactor int,
InterestedHouses varchar(64)
);
INSERT INTO Persons(FirstName,LastName,Age,DegreeID,YearOfStudy,Gender,HouseID) Values ("bob","fhaserman",18,32,1,1,1);
INSERT INTO Persons(FirstName,LastName,Age,DegreeID,YearOfStudy,Gender,HouseID) Values ("situan","cooldude",19,52,1,0,1);
INSERT INTO Persons(FirstName,LastName,Age,DegreeID,YearOfStudy,Gender,HouseID) Values ("doloman","mctush",20,21,4,1,2);
INSERT INTO Persons(FirstName,LastName,Age,DegreeID,YearOfStudy,Gender,HouseID) Values ("fly","sanitman",18,32,1,1,1);
INSERT INTO Persons(FirstName,LastName,Age,DegreeID,YearOfStudy,Gender,HouseID) Values ("percy","mcnuggests",19,61,2,1,3);
INSERT INTO Persons(FirstName,LastName,Age,DegreeID,YearOfStudy,Gender,HouseID) Values ("mary","popper",18,21,2,0,3);
INSERT INTO Persons(FirstName,LastName,Age,DegreeID,YearOfStudy,Gender,HouseID) Values ("julie","cildren",18,52,4,0,2);
INSERT INTO Persons(FirstName,LastName,Age,DegreeID,YearOfStudy,Gender,HouseID) Values ("mildred","tieteribble",21,12,1,0,2);
DROP TABLE House;
CREATE TABLE HOUSE(
HouseID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(HouseID),
Capacity int,
FilledCapacity int,
Type varchar(64),
Address varchar(255),
Postcode varchar(255),
Price float,
GenderRestriction int,
ContractLength int,
url varchar(2048)
);
INSERT INTO House(Capacity,FilledCapacity,Type,Address,Postcode,Price,GenderRestriction,ContractLength,url) Values (5,3,"FLAT","Mill Lane","EX0 IRA",145.00,0,41,"http://www.ferndale-dental.co.uk/images/house.jpg");
INSERT INTO House(Capacity,FilledCapacity,Type,Address,Postcode,Price,GenderRestriction,ContractLength,url) Values (4,2,"HOUSE","Heavitree", "EX5 HVT",98.00,0,51,"http://www.keelestudentaccommodation.com/wp-content/uploads/2016/01/43-whitehouse-rd.jpg");
INSERT INTO House(Capacity,FilledCapacity,Type,Address,Postcode,Price,GenderRestriction,ContractLength,url) Values (7,0,"HOUSE","Somewhere Street","EX2 ???",120.00,0,51,"www.westkirbyletting.co.uk/userimages/ALBERT%20EDWARD%2053%20DEC%2011%20003.jpg");