<?php
session_start();
//check for required fields from the form
if ((filter_input(INPUT_POST, 'username'))
        && (filter_input(INPUT_POST, 'password'))) {
//connect to server and select database
    $mysqli = mysqli_connect("localhost", "root", "karmakali", "VWTMaintenance");    //change these values to match vwt database
//create and issue the query
    $targetname = filter_input(INPUT_POST, 'username');
    $targetpasswd = filter_input(INPUT_POST, 'password');
    $sql = "SELECT username, auth FROM employees WHERE username = '".$targetname.
        "' AND pass = PASSWORD('".$targetpasswd."')";
		
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
//get the number of rows in the result set; should be 1 if a match
    if (mysqli_num_rows($result) == 1) {

	//if authorized, get the values of f_name l_name
	while ($info = mysqli_fetch_array($result)) {
		$username = stripslashes($info['username']);
		$auth = stripslashes($info['auth']);
	}

	//set authorization cookie
	setcookie("auth", $auth, time()+60*12, "/", "", 0);
	//set username cookie
	setcookie("username"), $username, time()+60*12, "/", "", 0);
	//redirect to request queue
        $_SESSION['LogError'] = "";
        header('Location: requestQueue.php');
        
    } else {
	//redirect back to login form if not authorized
        $_SESSION['LogError'] = "Incorrect username or password";
	header('Location: loginPage.php');
    }
}
?>
<h1>Login</h1>
	<h2><strong>Please enter your Email and Password</strong></h2>
<hr/>
<?php if(isset($_SESSION['LogError'])) echo "<h2>".$_SESSION['LogError']."</h2>";?>
<form method="POST" action="">
<label>Username</label>
<input type="text" name="username" required></br>
<label>Password</label>
<input type="password" name = "password" required></br>
<input type="reset">&nbsp;<input type="submit">
</form>