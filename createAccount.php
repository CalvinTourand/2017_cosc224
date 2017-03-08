<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<title>Create Account</title>
</head>

<body>
	<h1>Create Account</h1>
	<form action="" method="POST">
		Username:<br>
		<input type="text" name="username"><br>
		First name:<br>
		<input type="text" name="fname"><br>
		Last name:<br>
		<input type="text" name="lname"><br>
		Authority:<br>
		<select name="authority" onchange="changeAuthority()">
         <option value="employee">Employee
         <option value="maintenance">Maintenance
         <option value="manager">Manager
      </select><br>
		Password:<br>
		<input type="password" name="password"><br>
		Confirm password:<br>
		<input type="password" name="confirm"><br>            
		<input type="submit" ></input>
		<input type="reset" ></input>
   </form>
</body>

<?php
$db_user = $_POST['username'];
$db_fname = $_POST['fname'];
$db_lname = $_POST['lname'];
$db_auth = $_POST['authority'];
$db_pass = $_POST['password'];

$username="vwts";
$password="6iekgr3R8xyC";
$database="information_schema";

$con=mysqli_connect("localhost",$username,$password,$database);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  mysqli_query($con,"INSERT INTO employees (username, fName, lName, auth, pass) 
VALUES (".$db_user.", ".$db_fname.", ".db_lname.", ".db_auth.", ".db_pass.")");

// Print auto-generated id
echo "New record has id: " . mysqli_insert_id($con);

mysqli_close($con); 
//put header here to redirect back to login page
?>
</html>