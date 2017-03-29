<script src='https://code.jquery.com/jquery-1.11.3.min.js'></script>
<script src='https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js'></script>
<script>
$(document).ready( function() {
    $('.ui-loader').hide();
});
</script>
<style>
.tableStuff {padding: 2em;
        border-bottom: 1px solid grey; 
        text-align: center;}
.filterDiv  {float: left;
             padding: 5px;}
/*  <!-- CSS for making the buttons look nice. Example: Border shade on buttons -->  */

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
<h1>Maintenance Request</h1>
<h2>Queue of requested maintenance</h2>
<hr>
<!--Link to Maintenance Request Form
<a href=''data-role="none" value = ""class = ""><button>Request Maintenance Form</button></a>
<!--Link for managers to create new employee account-->
<table>
	<tr>
		<td><a href='#createRequest' data-rel='popup' data-position-to='window'><button>New Maintenance Request</button></a><br>
		<td><a href='http://localhost/wordpress/?page_id=2032' data-role="none"><button>Create Employee Account</button></a><br>
</table>

<!--Filter by option form-->
<form method='POST'>
<h3>Filter by:</h3>
    <!--Filter by sites-->
    <div class='filterDiv'><h3>Site:</h3>
    <select data-role = "none" id='selectSite'>
        <option value='Transition_House'>Transition House
        <option value='Casimir_Court'>Casimir Court
        <option value='46th_Avenue'>46th Avenue
        <option value='Armstrong'>Armstrong
        <option value='Courthouse'>Courthouse
        <option value='Creekside'>Creekside
    </select></div>
    <!--Filter by programs-->
    <div class='filterDiv'><h3>Program:</h3>
    <select data-role = "none"  id='selectProgram'>
      <option value='None'>Program
      <option value='Transition_House'>Transition House
      <option value='Support_to_Young_Parents'>Support to Young Parents
      <option value='Casimir_Court'>Casimir Court
      <option value='Oak_Centre'>Oak Centre
      <option value='Administration'>Administration
      <option value='Children_Who_Witness_Abuse_Vernon'>Children Who Witness Abuse – Vernon
      <option value='Children_Who_Witness_Abuse_Armstrong'>Children Who Witness Abuse – Armstrong
      <option value='Stopping_the_Violence_Vernon'>Stopping the Violence – Vernon
      <option value='Stopping_the_Violence_Armstrong'>Stopping the Violence – Armstrong
      <option value='Outreach'>Outreach
      <option value='Specialized_Victim_Assistance'>Specialized Victim Assistance
      <option value='Homelessness_Prevention'>Homelessness Prevention
      <option value='Legal_Services_Community_Partner'>Legal Services Community Partner
      <option value='Prevention_&_Awareness'>Prevention & Awareness
      <option value='Other'>Other
    </select></div>
    <!--Filter by status-->
    <div class='filterDiv'><h3>Status:</h3>
    <select data-role = "none" id='selectStatus'>
      <option value='None'>Status 
      <option value='Completed'>Completed
      <option value='notCompleted'>Not Completed
      <option value='notYetApproved'>Not Yet Approved
      <option value='notApproved'>Not Approved
    </select></div>
    <!--Filter by priority-->
    <div data-role = "none" class='filterDiv' ><h3>Priority:</h3>
    <select data-role = "none" id='selectPriority'>
      <option value='None'>Priority  
      <option value='High'>High
      <option value='Medium'>Medium
      <option value='Low'>Low
    </select></div>
    <!--Filter by Request Date -->
    <div class='filterDiv'><h3>Request Date:</h3>
    <input  type='date' data-date-inline-picker='true'/></div>
    <!--Filter by Approve Date -->
    <div class='filterDiv'><h3>Approval Date:</h3>
    <input  type='date' data-date-inline-picker='true'/></div>
    <!--Filter by Completed Date -->
    <div class='filterDiv'><h3>Completed Date:</h3>
    <input type='date' data-date-inline-picker='true'/></div>
    <div class='filterDiv' style='padding-top:2em'>
	<input type='button' value='Filter'style = "position:absolute; color:transparent; border:none; background-color:transparent;"></div>
</form>

<!-- Begin of Open Request Form -->
		
<div data-role="popup" id="openRequest" class="ui-content" style="padding-left: 10px; padding-right:10px; background-color: white; position: relative; min-width: 1000px; min-height: 600px; z-index:991000;">
	<a href="#" data-rel="back" data-role="button" class="ui-btn-right" data-shadow = "false" style = "text-decoration: none; top:1px; right:1px;">X</a>
		
		<?php
		//Connecting to Database
		$mysqli = mysqli_connect('localhost', 'vwts_dbman1', 'p0]K,S5Tm,7U', 'vwts_wpdb1'); 
		$info = findItem(4, $mysqli);
		$request_title = stripslashes($info['reqTitle']);
        $site_name = stripslashes($info['site']);
        $program = stripslashes($info['program']);
        $priority = stripslashes($info['priority']);
        $reqDate = stripslashes($info['reqDate']);
        $appvDate = stripslashes($info['approvalDate']);
        $compDate = stripslashes($info['completionDate']);
        $status = stripslashes($info['status']);
        $description = stripslashes($info['description']);
        $lName = stripslashes($info['lName']);
        $fName = stripslashes($info['fName']);
		$notes = stripslashes($info['approvalNotes'])." ".stripslashes($info['completionNotes']);?>
		<b>Title: </b><?php echo $request_title;?><hr>
		<div style = "position: absolute; width:25%; top:10%;">
			<b>Status</b>
			<?php echo $status; ?><hr><br>
			<b>Priority</b>
			<?php echo $priority; ?><hr><br>				
		</div>
		<div style = "position: absolute; width:25%; top:10%; left:25%;">
			<b>Employee</b><br>
			<?php echo $fName." ".$lName;?><hr>
			<b>Request Date</b>
			<?php echo $reqDate;?><hr><br>
			
		</div>
		<div style = "position: absolute; width:25%; top:10%; left:50%;">
			<b>Site</b><br>
			<?php echo $site_name;?><hr>
			<b>Approval Date</b>
			<?php echo $appvDate;?><hr><br>
		</div>
		<div style = "position: absolute; width:25%; top:10%; left:74%;">
			<b>Program</b><br>
			<?php echo $program;?><hr>
			<b>Completion Date</b>
			<?php echo $compDate?><hr><br>
		</div>
			
		<div style = "position: absolute; width:100%; height:22%; top:33%;">
			<b>Description</b><br>
			<textarea data-role="none" cols='70' rows='3' name='description' style ="resize:none; width:97%;height:100%"><?php echo $description."\r\nNotes:\r\n".$notes; ?></textarea>
		</div>
		<div style = "position: absolute; width:100%; height:22%; top:60%;">
			<b>Notes</b><br>
			<textarea name='notes' data-role="none" style ="resize:none; width:97%; height: 100%"></textarea>
		</div>
		<div style = "position: absolute; width:47%; top:88%;">
			<input type='submit' value = "Complete" name='complete' style = "position:absolute;color:transparent;border:none;background-color:transparent;">
		</div>
		<div style = "position: absolute; left:51.5%; width:47%; top:88%;">
			<input type='submit' value = "Submit" name='approve' style = "position:absolute;color:transparent;border:none; background-color:transparent;">
		</div>
	</div>
		
		<!-- Begin of the create request form -->
		<div data-role="popup" id="createRequest" class="ui-content" style="background-color: white; position: relative; min-width:700px; min-height: 465px; z-index:991000;">
			<a href="#" data-rel="back" data-role="button" class="ui-btn-right" data-shadow = "false" style = "text-decoration: none; top:1px; right:1px;">X</a> 
			<!-- Request form -->
			<h3><strong>Maintenance Request Form</strong></h3>
			<hr />
			<form name="loginForm" action="Request Form.php" method="post">
				<strong>
				<!-- Container for Left side of form -->
				<div style= "position: absolute; top: 17%; width: 47%;">				
					Title: <input type="text"id = "title" style = "width: 100%">
					Priority:
					<select id="selectPriority" style = "position: absolute; opacity:0; background-color:transparent;  top:0px; left:0px; width:100%; height:100%;"> 
					  <option value="Low">Low
					  <option value="Medium">Medium
					  <option value="High">High
					</select>
					
					Locations:  
					<select id="selectSite" class = "prettySelect" style = "position: absolute; opacity:0; background-color:transparent;  top:0px; left:0px; width:100%; height:100%;"> 
						<option value="Transition House">Transition House
						<option value="Casimir Court">Casimir Court
						<option value="46th Avenue">46th Avenue
						<option value="Armstrong">Armstrong
						<option value="Courthouse">Courthouse 
						<option value="Court Creekside">Court Creekside 
					</select>
					
					Program:
					<select id="selectProgram" style = "position: absolute; opacity:0; background-color:transparent;  top:0px; left:0px; width:100%; height:100%;"> 
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
					<input type = "submit" name="SubmitButton" style = "border:none; background-color:transparent;"></div>
			</form>
		</div>

<!--Start of request queue-->
<table style = "border-collapse: collapse; width: 100%; border: 1px solid grey;">
    <tr class = "tableStuff">
        <th class = "tableStuff">Request Title</th>
        <th class = "tableStuff">Site</th>
        <th class = "tableStuff">Program</th>
        <th class = "tableStuff">Priority</th>
        <th class = "tableStuff">Request Date</th>
        <th class = "tableStuff">Approval Date</th>
        <th class = "tableStuff">Finished Date</th>
        <th class = "tableStuff">Status</th>
        <th class = "tableStuff"></th>
    </tr class = "tableStuff">

<?php
//Start session for session variables
//session_start();
//tableOffset to manage pages displayed on queue
$tableOffset;
if(isset($_GET['offset']) && $_GET['offset'] >= 0){
    $tableOffset = $_GET['offset'];
}else{
	$tableOffset = 0;
}
//Clearing any errors created in the Create Account Page
//unset($_SESSION['CreateError']);


//Selecting Queue items from request table
$sql = "SELECT reqTitle, priority,
    program, site, description, 
    reqDate, approvalDate, completionDate, status, username, reqID
    FROM requests
    LIMIT 10 OFFSET ".$tableOffset;
//Querying database
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($result) >= 1) {
    while ($info = mysqli_fetch_array($result)) {
        //Filtering database query to variables
        $request_title = stripslashes($info['reqTitle']);
        $site_name = stripslashes($info['site']);
        $program = stripslashes($info['program']);
        $priority = stripslashes($info['priority']);
        $program = stripslashes($info['program']);
        $request_date = stripslashes($info['reqDate']);
        $approval_date = stripslashes($info['approvalDate']);
        $finished_date = stripslashes($info['completionDate']);
        $status = stripslashes($info['status']);
        $description = stripslashes($info['description']);
        $reqID = stripslashes($info['reqID']);
        //Displaying filtered query to page. As well as link to detailed page using id with get.
        echo "
            <tr>
                <td>".$request_title."</td>
                <td>".$site_name."</td>
                <td>".$program."</td>
                <td>".$priority."</td>
                <td>".$request_date."</td>
                <td>".$approval_date."</td>
                <td>".$finished_date."</td>
                <td>".$status."</td>
				<td><a href='#openRequest' data-rel='popup' data-position-to='window'> More Info</a></td>
                <!--<td><a href='http://localhost/wordpress/?page_id=1805&id=".$reqID."&offset=".$tableOffset."'>More Info</a></td>-->
            </tr>";
    }
}
if(mysqli_num_rows($result) >= 10){
	$tableOffsetNext = $tableOffset + 10;
}else{
	$tableOffsetNext = $tableOffset;
}

$display =
	 "</table>
	  <table>
		<tr>
			<td><div style='text-align:right;'><a href='http://localhost/requestQueue.php?offset=".($tableOffset-10)."'><button>Previous</button>
			<td></a> <a href='http://localhost/requestQueue.php?offset=".$tableOffsetNext."'><button>Next</button></a></div>
	  </table>";
echo $display;

if (isset($_POST['complete']) && isset($_GET['id']))
    completeRequest(filter_input(INPUT_GET,id), filter_input(INPUT_POST,notes), $mysqli);
if (isset($_POST['approve']) && isset($_GET['id']))
    approveRequest(filter_input(INPUT_GET,id), filter_input(INPUT_POST,notes), $mysqli);
//If queue item selected display the details page
if (isset($_GET['id'])) 
    findItem(filter_input(INPUT_GET,id), $mysqli);

//Function to output priority
function choosePriority($proiLevel){
    $priority;
    switch($proiLevel){
        case 1:
        $priority = 'Low';
        break;
        case 2:
        $priority = 'Medium';
        break;
        case 3:
        $priority = 'High';
        break;
        default:
        $priority = 'No Priority';
        break;
    }
    return $priority;
}

//Updating requests when completed
function completeRequest($id, $notes, $sqliConnect){
    $completeSQL = "UPDATE requests
            SET completionDate= SYSDATE(), completionNotes='".$notes."', status='Completed'
            WHERE reqID=".$id.";";
    $completeResult = mysqli_query($sqliConnect, $completeSQL) or die(mysqli_error($sqliConnect));
}

//Updating requests when approved
function approveRequest($id, $notes, $sqliConnect){
    $completeSQL = "UPDATE requests
            SET approvalDate= SYSDATE(), approvalNotes='".$notes."', status='Approved'
            WHERE reqID=".$id.";";
    $completeResult = mysqli_query($sqliConnect, $completeSQL) or die(mysqli_error($sqliConnect));
}

//Takes in choosen id and the sqli connection
function findItem($id, $sqli){
    //Selecting data for detailed report
    $findsql = "SELECT reqTitle, priority, program, site, description, 
        reqDate, approvalDate, completionDate, approvalNotes, completionNotes, status, e.fName, e.lName
        FROM requests r, employees e
        WHERE ".$id." = reqID;";
    $findresult = mysqli_query($sqli, $findsql) or die(mysqli_error($sqli));
    if(mysqli_num_rows($findresult) >= 1) {
        //Storing filtered data
        $info = mysqli_fetch_array($findresult);
		return $info;
	}
}
?>
</html>
