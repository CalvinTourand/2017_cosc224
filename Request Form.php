<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<body>
	<!-- 
		data role sets attributes from the js script imported above.
		Class sets the css for that component.
	-->
	<div data-role="main" class="ui-content" style = "width:100%; height:100%;">

		<!--href is used to refer to the form, it should be the sae as the form's id. -->
		<a href="#createRequest" data-rel="popup"> Create Maintenance Request Form</a>
		<div data-role="popup" id="createRequest" class="ui-content" style="position: relative; left: 50%; top: 70%; min-width:700px; min-height: 417px;">
			<!-- Request form -->
			<h3><strong>Maintenance Request Form</strong></h3>
			<hr />
			<form name="loginForm" action="/contact/" method="post">
				<strong>
				<!-- Container for Left side of form -->
				<div style= "position: absolute; top: 15%; width: 47%;" >				
					Title: <input type="text" id = "title">

					Priority:
					<select id="selectPriority"> 
					  <option value="Low">Low
					  <option value="Medium">Medium
					  <option value="High">High
					</select>
	
					Program:
					<select id="selectProgram"> 
						<option value="Transition House">Transition House
						<option value="Support to Young Parents">Support to Young Parents
						<option value="Casimir Court">Casimir Court
						<option value="Oak Centre">Oak Centre
						<option value="Administration">Administration
						<option value="Children Who Witness Abuse – Vernon">Children Who Witness Abuse – Vernon
						<option value="Children Who Witness Abuse – Armstrong">Children Who Witness Abuse – Armstrong
						<option value="Stopping the Violence – Vernon">Stopping the Violence – Vernon
						<option value="Stopping the Violence – Armstrong">Stopping the Violence – Armstrong
						<option value="Outreach">Outreach
						<option value="Specialized Victim Assistance">Specialized Victim Assistance
						<option value="Homelessness Prevention">Homelessness Prevention
						<option value="Legal Services Community Partner">Legal Services Community Partner
						<option value="Prevention & Awareness">Prevention & Awareness
						<option value="Other">Other
					</select>
				
					Locations:  
					<select id="selectSite"> 
						<option value="Transition House">Transition House
						<option value="Casimir Court">Casimir Court
						<option value="46th Avenue">46th Avenue
						<option value="Armstrong">Armstrong
						<option value="CourtCourthouse">CourtCourthouse 
						<option value="CourtCreekside">CourtCreekside 
					</select>
				</div>

				<!-- Right side of Form -->
				<div style="position: absolute; left:51%; top: 15%;  width: 87%; height:63%; width: 50%;">
					Description:	
					<div style = "position: absolute; top: 10%; height:100%; width:100%;"> 
						<textarea data-role="none" name="description" style ="height: 96%; width:92%; top:10%; resize:none" ></textarea>	
					</div>	
				</div>

				<!-- Reset and Submit buttons -->
				<div style= "position: absolute;  top: 85%; width: 47%; ">
					<input type = "reset" value = "reset"> </div>
				<div style = "position: absolute; top: 85%; width: 47%; left: 51%;">	
					<input type = "submit" value = "submit"> </div>
			</form>
		</div>
	</div>
</body>
<!--[insert_php]-->
<?php
$site = $_POST['site'];
$program = $_POST['program'];
$title = $_POST['title'];
$requestDate = $_POST['requestDate'];
$employee = $_POST['employee'];
$priority = $_POST['priority'];

Request made on: ".$requestDate."\n
Site: ".$site."\n
Program: ".$site."\n
Priority: ".$priority."\n
Request Title: ".$title."\n
Description:\n".$description."\n\n"

$message = "A maintenance request has been submitted by ".$employee.":\n
mail('teamvwt@gmail.com', 'Maintenance Request', $message);
header('location: http://localhost/wordpress/?page_id=1938');
}
else{
	header('location: http://localhost/wordpress/createAccount.php');
}
?>
<!--[/insert_php]-->
</html>