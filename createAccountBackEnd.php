<?php
/*
previous variables
$empUser - username employee gets [combo of fname and lname?]
$fname - first name
$lname - last name
$authority - 1 (employee), 2(maintenance), 3(manager)
$empPass - employee choosen password
*/

$servername = "test"
$username = "paige"
$password = "pass"
$dbname = "emps" //name of database to insert new employee info into

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if($conn -> connect_error)
	die("Connection failed" . $conn->connect_error);

$sql = "INSERT INTO emps (id, fname, lname, empUsername, authority, empPass) VALUES ("
?>