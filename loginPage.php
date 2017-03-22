<?php
session_start();
//check for required fields from the form
if ((filter_input(INPUT_POST, 'username'))
        && (filter_input(INPUT_POST, 'password'))) {
//connect to server and select database
    $mysqli = mysqli_connect("localhost", "vwts_dbman1", 'p0]K,S5Tm,7U', "vwts_wpdb1");    //change these values to match vwt database
//create and issue the query
    $targetname = filter_input(INPUT_POST, 'username');
    $targetpasswd = filter_input(INPUT_POST, 'password');
    $sql = "SELECT fName, lName, auth FROM employees WHERE username = '".$targetname.
        "' AND pass = PASSWORD('".$targetpasswd."')";
		
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
//get the number of rows in the result set; should be 1 if a match
    if (mysqli_num_rows($result) == 1) {
	//if authorized, get the values of f_name l_name
	while ($info = mysqli_fetch_array($result)) {
		$f_name = stripslashes($info['fName']);
		$l_name = stripslashes($info['lName']);
                $auth = stripslashes($info['auth']);
	}
	//set authorization cookie
	setcookie("auth", $auth, time()+60*12, "/", "", 0);
        //need to set cookies for auth level and employee names
	//redirect to request queue
        $_SESSION['LogError'] = "";
        header('Location: http://localhost/wordpress/?page_id=1805');
        
    } else {
	//redirect back to login form if not authorized
        $_SESSION['LogError'] = "Incorrect username or password";
	header('Location: http://localhost/wordpress/?page_id=1938');
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
