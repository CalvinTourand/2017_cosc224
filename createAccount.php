<body>
	<h1>Create Account</h1>
	<h2><strong>Please enter credentials for a new employee account</strong></h2>
	<hr />
	<?php /*[insert_php]*/if($_SESSION['CreateError']){echo"
		<h2>".$_SESSION['logError']."</h2>";} /*[/insert_php]*/?>
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
		<input type="submit" name="submit" >
		<input type="reset" name="reset" >
   </form>
</body>

<!--[insert_php]-->
<?php
session_start();
if ((filter_input(INPUT_POST, 'confirm'))
        && (filter_input(INPUT_POST, 'password'))) {
    if ($_POST['password'] == $_POST['confirm']){
    $_SESSION['CreateError'] = "";
    $authority;
    switch($_POST['authority']){
        case "employee":
        $authority = 1;
        break;
        case "maintenance":
        $authority = 2;
        break;
        case "manager":
        $authority = 3;
        break;
    }
    $username="vwts_dbman1";
    $password="p0]K,S5Tm,7U";
    $database="vwts_wpdb1";
    $con=mysqli_connect("localhost",$username,$password,$database);
    // Check connection
    if (mysqli_connect_errno()){echo "Failed to connect to MySQL: " . mysqli_connect_error();}

    $result = mysqli_query($con,"INSERT INTO employees VALUES ('".$_POST['username']."', '".$_POST['fname']."', '".$_POST['lname']."', ".$authority.", PASSWORD('".$_POST['password']."'))");
    echo $result." is the result";
    mysqli_close($con);
    //put header here to redirect back to login page
    header('location: http://localhost/wordpress/?page_id=1805');
    }else{
            $_SESSION['CreateError'] = "Passwords Do Not Match";
            header('location: http://localhost/wordpress/?page_id=2032');
    }
}
?>
<!--[/insert_php]-->
