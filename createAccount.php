<h1>Create Account</h1>
<h2><strong>Please enter credentials for a new employee account</strong></h2>
<hr />

[insert_php]
session_start();
unset($_SESSION['sql']);
if(!isset($_COOKIE['username'])){
    $_SESSION['LogError'] = "Session has timed out";
    header('location: http://vwts.ca/employeelogin');
}elseif($_COOKIE['auth'] != 3){
    header('location: http://vwts.ca/requestqueue');
}
if ((filter_input(INPUT_POST, 'confirm'))
        && (filter_input(INPUT_POST, 'password'))) {
    if ($_POST['password'] == $_POST['confirm']){
    unset($_SESSION['CreateError']);
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
    header('location: REQUESTQUEUE');
    }else{
        $_SESSION['CreateError'] = "Passwords Do Not Match";
        header('location: CREATEACCOUNT');
    }
}
[/insert_php]

[insert_php]if($_SESSION['CreateError']){
     echo"<h2>".$_SESSION['CreateError']."</h2>";} [/insert_php]

<form action="" method="POST">Username:
<input name="username" type="text" required/>
<label>First name:</label>
<input name="fname" type="text" required/>
<label>Last name:</label>
<input name="lname" type="text" required/>
<label>Authority:</label>
<select style="padding: 2px;" name="authority">
<option value="employee">Employee</option>
<option value="maintenance">Maintenance</option>
<option value="manager">Manager</option>
</select>
<label>Password:</label>
<input name="password" type="password" required/>
<label>Confirm password:</label>
<input name="confirm" type="password" required/>

<input name="reset" type="reset" /> <input name="submit" type="submit" />
<a href="http://vwts.ca/employeelogin/requestqueue">Back</a>
</form>&nbsp;
