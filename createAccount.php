<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<title>Create Account</title>
</head>

<body>
	<h1>Create Account</h1>
	<form>
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
</html>