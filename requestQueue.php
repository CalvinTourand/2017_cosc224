</table>
<style>
table {border-collapse: collapse;
    width: 100%;}
th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid black;}
</style>

<h1>Maintenance Request</h1>
<button>Request Maintenance Form</button><br>
<!-- <?php echo ".$sql."; ?> for testing -->
Filter by:<br>
<form action ='requestQueue.php' method="POST">Site:<br> <!--change action to suit server-->
    <select id='selectSite' name='selectSite' style='padding:5px;'>
		<option value='None'>Site</option>
        <option value='Transition_House'> Transition House</option>
        <option value='Casimir_Court'> Casimir Court</option>
        <option value='46th_Avenue'>46th Avenue</option>
        <option value='Armstrong'>Armstrong</option>
        <option value='Courthouse'>Courthouse</option>
        <option value='Creekside'>Creekside</option>
    </select>
    Program:<br>
    <select  id='selectProgram' name='selectProgram' style='padding:5px;'>
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
    </select>
    Status:<br>
    <select id='selectStatus' name='selectStatus' style='padding:5px'>
      <option value='None'>Status 
      <option value='Completed'>Completed
      <option value='notCompleted'>Not Completed
      <option value='notYetApproved'>Not Yet Approved
      <option value='notApproved'>Not Approved
    </select>
    Priotity:<br>
    <select id='selectPriority' name='selectPriority' style='padding:5px'>
      <option value='None'>Priority  
      <option value='High'>High
      <option value='Medium'>Medium
      <option value='Low'>Low
    </select>
    <!-- Request Date -->
    <br>Requested Between: <br>
	<input  type='date' name='reqDateMin' data-date-inline-picker='true' /> And&nbsp 
    <input  type='date' name='reqDateMax' data-date-inline-picker='true' /><br>
    <!-- Approve Date -->
    Approved Between:<br>
	<input  type='date' name='approvalDateMin' data-date-inline-picker='true' /> And&nbsp
	<input  type='date' name='approvalDateMax' data-date-inline-picker='true' /><br>
    <!-- Completed Date -->
    Completed Between:<br>
	<input  type='date' name='completedDateMin' data-date-inline-picker='true' /> And&nbsp
    <input type='date' name='completedDateMax' data-date-inline-picker='true' /><br>
    <input type='submit' value='Filter'>
</form>
<br><br>

<table padding: 15px; text-align: left;>
    <tr>
        <th>Request Title</th>
        <th>Site</th>
        <th>Program</th>
        <th>Priority</th>
        <th>Request Date</th>
        <th>Approval Date</th>
        <th>Finished Date</th>
        <th>Status</th>
        <th></th>
    </tr>
    
<!--[insert_php]-->
<?php
session_start();
echo $_POST['reqDateMax'];
if(!isset($_COOKIE['username'])) {
	$_SESSION['logError'] = "Session timed out";
	//header('Location: loginPage.php');
}
$username = $_COOKIE['username'];
$auth = $_COOKIE['auth'];
$mysqli = mysqli_connect("localhost", "root", "karmakali", "VWTMaintenance");
$sql = "SELECT reqTitle, priority,
    program, site, description, 
    reqDate, approvalDate, completionDate, status, username, reqID
    FROM requests";

//Beginning of dynamic queries

if(isset($_POST['selectSite']) && filter_input(INPUT_POST, 'selectSite') != 'None') {	//filter by site
	$selectSite = filter_input(INPUT_POST, 'selectSite');
	$sql .= " WHERE site = '".$selectSite."'";
	$MultipleAnds = TRUE;
	
}  
if(isset($_POST['selectProgram']) && filter_input(INPUT_POST, 'selectProgram') != 'None') {  //filter by program
	$selectProgram = filter_input(INPUT_POST, 'selectProgram');
	if($MultipleAnds == TRUE) { 
		$sql .= " AND "; 
	}else {
		$sql .=" WHERE ";
		$MultipleAnds = TRUE;
	}
	$sql .= "program = '".$selectProgram."'";
} 
if(isset($_POST['selectStatus']) && filter_input(INPUT_POST, 'selectStatus') != 'None') {  //filter by status
	$selectStatus = filter_input(INPUT_POST, 'selectStatus');
	if($MultipleAnds == TRUE){
		$sql .= " AND ";
	}else {
		$sql .=" WHERE ";
		$MultipleAnds = TRUE;
	}
	$sql .= "status = '".$selectStatus."'";
}
if(isset($_POST['selectPriority']) && filter_input(INPUT_POST, 'selectPriority') != 'None') {  //filter by priority
	$selectPriority = filter_input(INPUT_POST, 'selectPriority') ;
	if ($MultipleAnds == TRUE){
		$sql .= " AND ";
	}else{
		$sql .=" WHERE ";
		$MultipleAnds = TRUE;
	}
	$sql .= "priority = '".$selectPriority."'";
}
if($_POST['reqDateMin'] != NULL) {  //filter by request date
	$selectReqDateMin = filter_input(INPUT_POST, 'reqDateMin') ;
	if ($MultipleAnds == TRUE){
		$sql .= " AND ";
	}else{
		$sql .=" WHERE ";
		$MultipleAnds = TRUE;
	}
	if($_POST['reqDateMax'] == NULL) {
		$sql .= "(reqDate BETWEEN '".$selectReqDateMin." 00:00:00' AND SYSDATE())"; 
		echo "No max request-date chosen, using current date as max.";	//make this pretty.. use session variable 
	}else {
		$selectReqDateMax = filter_input(INPUT_POST, 'reqDateMax');
		$sql .= "(reqDate BETWEEN '".$selectReqDateMin." 00:00:00' AND '".$selectReqDateMax." 00:00:00')";
	}
}
if($_POST['approvalDateMin'] != NULL) {  //filter by approval date
	$selectApprovalDateMin = filter_input(INPUT_POST, 'approvalDateMin');
	if ($MultipleAnds == TRUE){
		$sql .= " AND ";
	}else{
		$sql .=" WHERE ";
		$MultipleAnds = TRUE;
	}
	if($_POST['approvalDateMax'] == NULL) {
		$sql .= "(approvalDate BETWEEN '".$selectApprovalDateMin."' AND SYSDATE())"; 
		echo "No max approval-date chosen, using current date as max.";	//make this pretty.. use session variable 
	}else {
		$selectApprovalDateMax = filter_input(INPUT_POST, 'approvalDateMax');
		$sql .= "(approvalDate BETWEEN '".$selectApprovalDateMin."' AND '".$selectApprovalDateMax."')";
	}
}
if($_POST['completedDateMin'] != NULL) {  //filter by completed date
	$selectCompletedDateMin = filter_input(INPUT_POST, 'completedDateMin');
	if ($MultipleAnds == TRUE){
		$sql .= " AND ";
	}else{
		$sql .=" WHERE ";
		$MultipleAnds = TRUE;
	}
	if($_POST['completedDateMax'] == NULL) {
		$sql .= "(completionDate BETWEEN '".$selectCompletedDateMin."' AND SYSDATE())"; 
		echo "No max completion-date chosen, using current date as max.";	//make this pretty.. use session variable 
	}else {
		$selectCompletedDateMax = filter_input(INPUT_POST, 'completedDateMax');
		$sql .= "(completionDate BETWEEN '".$selectCompletedDateMin."' AND '".$selectCompletedDateMax."')";
	}
}
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
if (mysqli_num_rows($result) >= 1) {
    while ($info = mysqli_fetch_array($result)) {
        //Objects with these variables
        $request_title = stripslashes($info['reqTitle']);
        $site_name = stripslashes($info['site']);
        $program = stripslashes($info['program']);
        $priority = stripslashes($info['priority']);
        $request_date = stripslashes($info['reqDate']);
        $approval_date = stripslashes($info['approvalDate']);
        $finished_date = stripslashes($info['completionDate']);
        $status = stripslashes($info['status']);
        $description = stripslashes($info['description']);
        $reqID = stripslashes($info['reqID']);
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
                <td><a href='http://localhost/wordpress/?page_id=1805&id=".$reqID."'>More Info</a></td>
            </tr>";
    }
}
if (isset($_GET['id'])) {
    findItem($_GET['id'], $mysqli);
}
function findItem($id, $sqli){
        $findsql = "SELECT reqTitle, priority, program, site, description, 
            reqDate, approvalDate, completionDate, status, e.fName, e.lName
            FROM requests r, employees e
            WHERE ".$_GET['id']." = reqID;";
        $findresult = mysqli_query($sqli, $findsql) or die(mysqli_error($sqli));
        if(mysqli_num_rows($findresult) >= 1) {
            while($info = mysqli_fetch_array($findresult)){
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
            
            echo"
            <table>
                <tr>
                    <th>Title</th><th>Request Date</th><th>Approval Date</th><th>Completion Date</th>
                </tr><tr>
                    <td>".$request_title."</td><td>".$reqDate."</td><td>".$appvDate."</td><td>".$compDate."</td>
                </tr><tr>
                    <th>Program</th><th>Site</th><th colspan='2'>Descripton</th>
                </tr><tr>
                    <td>".$program."</td><td>".$site_name."</td><td colspan='2' rowspan='3'>".$description."</td>
                </tr><tr>
                    <th>Employee</th><th>Priority</th>
                </tr><tr>
                    <td>".$fName." ".$lName."</td><td>".$priority."</td>
                </tr>
            </table>
            <h3>Notes</h3>
            <textarea cols='40' rows='3' name='notes'>Notes</textarea>
            <p><button value='complete'>Complete</button>
            <button value='approve'>Approve</button></p>";
}
        }
    }
?>
<!--[/insert_php]-->