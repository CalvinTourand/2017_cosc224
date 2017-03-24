<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width" />
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script>
$(document).ready( function() {
   $(".ui-loader").hide();
});
</script>
<style>
/*  <!-- CSS for making the buttons look nice. Example: Border shade on buttons -->  */
.ui-btn{opacity:1}.ui-select .ui-btn select{ /* <!-- CSS for drop down buttons --> */
	cursor:pointer;
	-webkit-appearance:button;
	position:absolute;
	left:0;
	top:0;
	width:100%;min-height:1.5em;min-height:100%;height:3em;max-height:100%;
	opacity:0;-ms-filter:"alpha(opacity=0)";
}
/* <!-- Adds padding and structure to the form --> */
.ui-content{border-width:0;overflow:visible;overflow-x:hidden;padding:15px} 
/*<!-- Shading for buttons --> */
.ui-btn,html head + body .ui-btn.ui-btn-a:visited{background-color:#f6f6f6 ;border-color:#ddd ;color:#333 ;text-shadow:0 1px 0 #f3f3f3 ;} 
.ui-overlay-shadow{-webkit-box-shadow:0 0 12px rgba(0,0,0,.6);-moz-box-shadow:0 0 12px rgba(0,0,0,.6);box-shadow:0 0 12px rgba(0,0,0,.6);}
.ui-shadow{-webkit-box-shadow:0 1px 3px rgba(0,0,0,.15) ;-moz-box-shadow:0 1px 3px rgba(0,0,0,.15) ;box-shadow:0 1px 3px rgba(0,0,0,.15) ;}
.ui-btn,label.ui-btn{font-weight:bold;border-width:1px;border-style:solid;} 
.ui-btn{font-size:16px;margin:.5em 0;padding:.7em 1em;display:block;position:relative;text-align:center;cursor:pointer;}
.ui-popup-screen.out{opacity:0;filter:Alpha(Opacity=0);}
.ui-popup-container{z-index:991100;display:inline-block;position:absolute;padding:0;outline:0;}
.ui-popup-truncate{height:1px;width:1px;margin:-1px;overflow:hidden;clip:rect(1px,1px,1px,1px);}
.ui-btn-right{position:absolute;top:-11px;margin:0;z-index:991101;}
.ui-btn-right{right:-11px;}
</style>
<body>
	<!-- 
		data role sets attributes from the js script imported above.
		Class sets the css for that component.
	-->
	<div data-role="main" class="ui-content" style = "width:100%; height:100%; z-index:991000;">
		<!--href is used to refer to the form, it should be the sae as the form's id. -->
		
		<a href="#createRequest" data-rel="popup" data-position-to="window"> Create Maintenance Request Form</a>
		<div data-role="popup" id="createRequest" class="ui-content" style="position: relative; min-width:700px; min-height: 465px; z-index:991000;">
			<a href="#" data-rel="back" data-role="button" class="ui-btn-right" data-shadow = "false" style = "text-decoration: none; top:1px; right:1px;">X</a> 
			<!-- Request form -->
			<h3><strong>Maintenance Request Form</strong></h3>
			<hr />
			<form name="requestForm" action="Request Form.php" method="POST">
				<strong>
				<!-- Container for Left side of form -->
				<div style= "position: absolute; top: 17%; width: 47%;">				
					Title: <input type="text"id = "title" style = "width: 100%">
					Priority:
					<select id="selectPriority">
					  <option value="">Choose Priority
					  <option value="Low">Low
					  <option value="Medium">Medium
					  <option value="High">High
					</select>
					
					Locations:  
					<select id="selectSite"> 
						<option value="">Choose Site
						<option value="Transition House">Transition House
						<option value="Casimir Court">Casimir Court
						<option value="46th Avenue">46th Avenue
						<option value="Armstrong">Armstrong
						<option value="Courthouse">Courthouse 
						<option value="Court Creekside">Court Creekside 
					</select>
					
					Program:
					<select id="selectProgram"> 
						<option value="">Choose Program
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
				
					
				</div>

				<!-- Right side of Form -->
				<div style="position: absolute; left:51%; top: 17%;  width: 87%; height:65%; width: 50%;">
					Description:	
					<div style = "position: absolute; top: 7%; height:100%; width:100%;"> 
						<textarea data-role="none" name="description" style ="height: 96%; width:92%; top:10%; resize:none" ></textarea>	
					</div>	
				</div>
				<br>
				<!-- Reset and Submit buttons -->
				<div style= "position: absolute;  top: 85%; width: 47%; ">
					<input type = "reset" style = "width: 100%; height:100%; border:none; background-color:transparent;"> </div>
				<div style = "position: absolute; top: 85%; width: 47%; left: 51%;">	
					<input type = "submit" style = "border:none; background-color:transparent;"></div>
			</form>
		</div>
	</div>
</body>
</html>
<?php

echo "hello";
/*$site = $_POST['site'];
$program = $_POST['program'];
$title = $_POST['title'];
$requestDate = $_POST['requestDate'];
$employee = $_POST['employee'];
$priority = $_POST['priority'];
$desc = $_POST['description'];


if(!$site || !$program || !$title || !$priority){
	
}

if((!filter-input(INPUT_POST,'title'))
	|| (!filter-input(INPUT_POST,'priority'))
	|| (!filter_input(INPUT_POST,'site'))
	|| (!filter-input(INPUT_POST,'program'))){

	}else{
	}
	}

		//specify FROM here
$fromHeader = "From: teamvwt@gmail.com";

//specify message to put in email here
$message = "A maintenance request has been submitted by ".$employee.":\n\n
Request made on: ".$requestDate."\n
Site: ".$site."\n
Program: ".$site."\n
Priority: ".$priority."\n
Request Title: ".$title."\n
Description:\n".$desc;

//send email to manager(s).  Specify TO, title, message to send (created above), and header(created above)
bool mail('teamvwt@gmail.com', 'Maintenance Request', $message, $headers);
	
	
header('location: http://localhost/wordpress/?page_id=1938');
*/
?>
<!--[/insert_php]-->
</html>