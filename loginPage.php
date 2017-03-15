<?php
//check for required fields from the form
//echo $_POST['username']." test ".$_POST['password']; 

if ((!filter_input(INPUT_POST, 'username'))
        && (!filter_input(INPUT_POST, 'password'))) {
	$testString = "post is not set";
}else {
//connect to server and select database
    $mysqli = mysqli_connect("localhost", "root", "karmakali", "VWTMaintenance");    //change these values to match vwt database

//create and issue the query
    $targetname = filter_input(INPUT_POST, 'username');
    $targetpasswd = filter_input(INPUT_POST, 'password');
    $sql = "SELECT fName, lName, auth FROM employees WHERE username = '".$targetname.
        "' AND pass = PASSWORD('".$targetpasswd."')";
		
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
//get the number of rows in the result set; should be 1 if a match
    if (mysqli_num_rows($result) == 1) {

	//if authorized, get the values of f_name l_name
	while ($info = mysqli_fetch_ array($result)) {
		$f_name = stripslashes($info['fName']);
		$l_name = stripslashes($info['lName']);
                $auth = stripslashes($info['auth']);
	}

	//set authorization cookie
	setcookie("auth", $auth, time()+60*12, "/", "", 0);
        //need to set cookies for auth level and employee names
	//redirect to request queue
        header("Location: requestQueue.php");
        
    } else {
	//redirect back to login form if not authorized
	header("Location: loginPage.php");
        $testString = "Incorrect username or password";
	exit;
    }
}

?>
<h1>Login</h1>
	<h2><strong>Please enter your Email and Password</strong></h2>
        <?php echo"$testString";?>
<hr/>

<form method="POST" action="loginPage.php">
<label>Username</label>
<input type="text" name="username"></br>
<label>Password</label>
<input type="password" name = "password"></br>
<input type="reset">&nbsp;<input type="submit">
</form>

