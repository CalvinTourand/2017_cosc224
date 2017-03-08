
<?php

echo $_POST['username'];
echo $_POST['fname'];
echo $_POST['lname'];
echo $_POST['authority'];
echo $_POST['password'];

$username="teamvwt@gmail.com";
$password="_2\"N%'sR8[p6";
$database="information_schema";

$con=mysqli_connect("localhost",$username,$password,$database);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  mysqli_query($con,"INSERT INTO employees (username, fName, lName, auth, pass) 
VALUES (username, fname, lname, authority, password)");

// Print auto-generated id
echo "New record has id: " . mysqli_insert_id($con);

mysqli_close($con); 
//put header here to redirect back to login page
?>

