[insert_php]
session_start();
if(!isset($_COOKIE['username'])){
    $_SESSION['LogError'] = "Session has timed out";
    header('location: http://vwts.ca/employeelogin');
}
[/insert_php]
<style>
table {border-collapse: collapse;
       width: 100%;}
th, td {padding: .5em; 
        border-bottom: 1px solid grey; 
        text-align: center;}
.filterDiv  {float: left;
             padding: 5px;}
select {padding: 5px;}
</style>

<h1>Maintenance Request</h1>
<form method="POST" action="http://vwts.ca/employeelogin">
<input style="float: right" type="submit" value="Logout" name="logout"></form>
<h3>Queue of requested maintenance</h3>
<hr>

[insert_php]
$Mainbuttons = "<div class='filterDiv'>
     <a href='http://vwts.ca/employeelogin/requestform'><button>Request Maintenance Form</button></a> ";
if($_COOKIE['auth'] == 3){
     $Mainbuttons .= "<a href='http://vwts.ca/employeelogin/createemployeeaccount'><button>Create Employee Account</button></a>";
}
$Mainbuttons .= "</div><br><br>";
echo $Mainbuttons;
[/insert_php]

<h2 style='padding-top: 2em'>Filter by:</h2><hr>
<form action ='' method="POST">
<table style='border: none'>
 <tr><th>Site:</th><th>Program:</th><th>Status:</th><th>Priority:</th></tr> 
    <tr><td><select id='selectSite' name='selectSite' style='padding:5px;'>
	<option value='None'>[insert_php]if(isset($_POST['selectSite']) && filter_input(INPUT_POST, 'selectSite') != 'None')
        echo $_POST['selectSite']; 
        else 
        echo "Any Site";[/insert_php]</option>
        <option value='Transition House'> Transition House</option>
        <option value='Casimir Court'> Casimir Court</option>
        <option value='46th Avenue'>46th Avenue</option>
        <option value='Armstrong'>Armstrong</option>
        <option value='Courthouse'>Courthouse</option>
        <option value='Creekside'>Creekside</option>
    </select></td>
    
<td>
    <select  id='selectProgram' name='selectProgram' style='padding:5px;'>
      <option value='None'>[insert_php]if(isset($_POST['selectProgram']) && filter_input(INPUT_POST, 'selectProgram') != 'None') echo $_POST['selectProgram']; else echo "Any Program";[/insert_php]
      <option value='Transition House'>Transition House
      <option value='Support to Young Parents'>Support to Young Parents
      <option value='Casimir Court'>Casimir Court
      <option value='Oak Centre'>Oak Centre
      <option value='Administration'>Administration
      <option value='Children Who Witness Abuse – Vernon'>Children Who Witness Abuse – Vernon
      <option value='Children Who Witness Abuse – Armstrong'>Children Who Witness Abuse – Armstrong
      <option value='Stopping the Violence – Vernon'>Stopping the Violence – Vernon
      <option value='Stopping the Violence – Armstrong'>Stopping the Violence – Armstrong
      <option value='Outreach'>Outreach
      <option value='Specialized Victim Assistance'>Specialized Victim Assistance
      <option value='Homelessness Prevention'>Homelessness Prevention
      <option value='Legal Services Community Partner'>Legal Services Community Partner
      <option value='Prevention & Awareness'>Prevention & Awareness
      <option value='Other'>Other
    </select></td>
    
<td>
    <select id='selectStatus' name='selectStatus' style='padding:5px'>
      <option value='None'>[insert_php]if(isset($_POST['selectStatus']) && filter_input(INPUT_POST, 'selectStatus') != 'None') echo $_POST['selectStatus']; else echo "Any Status";[/insert_php] 
      <option value='Completed'>Completed
      <option value='In Progress'>In Progress
      <option value='Approved'>Approved
      <option value='Pending'>Pending
      <option value='Cancelled'>Cancelled
    </select></td>
    
<td>
    <select id='selectPriority' name='selectPriority' style='padding:5px'>
      <option value='None'>[insert_php]if(isset($_POST['selectPriority']) && filter_input(INPUT_POST, 'selectPriority') != 'None') echo $_POST['selectPriority']; else echo "Any Priority";[/insert_php] 
      <option value='High'>High
      <option value='Medium'>Medium
      <option value='Low'>Low
    </select></td></tr>

<tr style='length:100%'><th>Requested Between:</th><th>Approval Between:</th><th>Completed Between:</th><th></th></tr>
<tr style='length:100%'><td>
	From: <input  type='date' name='reqDateMin' data-date-inline-picker='true' />
    To: <input  type='date' name='reqDateMax' data-date-inline-picker='true' /></td>
    <!-- Approve Date -->
    <td>
	From: <input  type='date' name='approvalDateMin' data-date-inline-picker='true' />
	To: <input  type='date' name='approvalDateMax' data-date-inline-picker='true' /></td>
    <!-- Completed Date -->
    <td>
	From: <input  type='date' name='completedDateMin' data-date-inline-picker='true' />
    To: <input type='date' name='completedDateMax' data-date-inline-picker='true' /></td>
    <td>
        <input type='submit' name='filter' value='Filter'>
        <input type='submit' name='clear' value='Clear Filter'></td></tr></table>
</form>
    
[insert_php]
//Connecting to Database
$mysqli = mysqli_connect("localhost", "vwts_dbman1", 'p0]K,S5Tm,7U', "vwts_wpdb1");

//tableOffset to manage pages displayed on queue
$tableOffset;
if(isset($_POST['offset']) && $_POST['offset'] >= 0){
    $tableOffset = $_POST['offset'];
}else{
	$tableOffset = 0;
}

if (isset($_POST['complete']) && isset($_POST['id']))
    updateRequest(filter_input(INPUT_POST,id), filter_input(INPUT_POST,comNotes), filter_input(INPUT_POST, detailPriority), $mysqli, 'Completed');
if (isset($_POST['approve']) && isset($_POST['id']))
    updateRequest(filter_input(INPUT_POST,id), filter_input(INPUT_POST,appNotes), filter_input(INPUT_POST, detailPriority), $mysqli, 'Approved');
if (isset($_POST['cancel']) && isset($_POST['id']))
    updateRequest(filter_input(INPUT_POST,id), filter_input(INPUT_POST,appNotes), filter_input(INPUT_POST, detailPriority), $mysqli, 'Cancelled');
if (isset($_POST['start']) && isset($_POST['id']))
    updateRequest(filter_input(INPUT_POST,id), filter_input(INPUT_POST,comNotes), filter_input(INPUT_POST, detailPriority), $mysqli, 'Started');
if (isset($_POST['delete']) && isset($_POST['id']))
    updateRequest(filter_input(INPUT_POST,id), '', '', $mysqli, 'Deleted');
//If queue item selected display the details page
if(isset($_POST['filter'])){
    $tableOffset = 0;
    unset($_POST['id']);}
if (isset($_POST['id'])) 
    findItem(filter_input(INPUT_POST,id), $mysqli);

echo"
<h2 style='padding-top: 2em'>Maintenance Queue</h2><hr>
<table>
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
    </tr>";
    
//Clearing any errors created in the Create Account Page
unset($_SESSION['CreateError']);
unset($_SESSION['LoginError']);

//Selecting Queue items from request table
$sql = "SELECT reqTitle, priority,
    program, site, description, 
    reqDate, approvalDate, completionDate, status, username, reqID
    FROM requests ";

if(!isset($_POST['filter'])){
    $sql .= "WHERE status = 'Pending' || status = 'Approved' || status = 'In Progress'";
}
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
	$selectPriority = changePriority((filter_input(INPUT_POST, 'selectPriority')));
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

$sql .= " ORDER BY reqDate, approvalDate, completionDate";

if(isset($_POST['filter'])){
    $_SESSION['sql'] = $sql;
}

if(isset($_POST['clear'])){
    unset($_SESSION['sql']);
    $tableOffset = 0;
}

if(isset($_POST['offset']) && ($_POST['offset'] >= 0 || $_POST['offset'] <= 0) && isset($_SESSION['sql'])){
    $sql = $_SESSION['sql'];
}

$sql .= " LIMIT 10 OFFSET ".$tableOffset;
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
                <td style='padding:1em'>".$request_title."</td>
                <td style='padding:1em'>".$site_name."</td>
                <td style='padding:1em'>".$program."</td>
                <td style='padding:1em'>".choosePriority($priority)."</td>
                <td style='padding:1em'>".$request_date."</td>
                <td style='padding:1em'>".$approval_date."</td>
                <td style='padding:1em'>".$finished_date."</td>
                <td style='padding:1em'>".$status."</td>
                <td style='padding:1em'><form action='' method='POST'><input type=hidden value='".$reqID."' name='id'><input type='submit' value='More Info'></form></td>
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
	 <div style='text-align:right;'><form action='' method='POST'>
         <input type='hidden' value='".($tableOffset-10)."' name='offset'><input type='submit' value='Previous'></form>
         <form action='' method='POST'>
         <input type='hidden' value='".$tableOffsetNext."' name='offset'><input type='submit' value='Next'></form>
         </form></div>";
echo $display;

//Function to output priority
function choosePriority($proiLevel){
    $priority;
    switch($proiLevel){
        case 1:
        $priority = "Low";
        break;
        case 2:
        $priority = "Medium";
        break;
        case 3:
        $priority = "High";
        break;
        default:
        $priority = "No Priority";
        break;
    }
    return $priority;
}

function changePriority($proiLevel){
    $priority;
    switch($proiLevel){
        case "Low":
        $priority = 1;
        break;
        case "Medium":
        $priority = 2;
        break;
        case "High":
        $priority = 3;
        break;
    }
    return $priority;
}

//Update Request On Cancel, Approve, Complete, Start
function updateRequest($id, $notes, $priority, $sqliConnect, $type){ 
    $completeSQL = "UPDATE requests SET ";
    switch($type){
        case "Completed":
        $completeSQL .= "completionDate=SYSDATE(), completionNotes='".$notes."', status='Completed' ";
        break;
        case "Cancelled":
        $completeSQL .= "approvalNotes='".$notes."', status='Cancelled', priority=".$priority." ";
        break;
        case "Approved":
        $completeSQL .= "approvalDate= SYSDATE(), approvalNotes='".$notes."', status='Approved', priority=".$priority." ";
        break;
        case "Started":
        $completeSQL .= "completionNotes='".$notes."', status='In Progress' ";
        break;
        case "Deleted":
        $completeSQL = "DELETE FROM requests ";
    }
    $completeSQL .= "WHERE reqID=".$id.";";
    $completeResult = mysqli_query($sqliConnect, $completeSQL) or die(mysqli_error($sqliConnect));
}

//Takes in choosen id and the sqli connection
function findItem($id, $sqli){
    //Selecting data for detailed report
    $findsql = "SELECT reqTitle, priority, program, site, description, 
        reqDate, approvalDate, completionDate, status, e.fName, e.lName, approvalNotes, completionNotes
        FROM requests r, employees e
        WHERE ".$id." = reqID AND r.username = e.username;";
    $findresult = mysqli_query($sqli, $findsql) or die(mysqli_error($sqli));
    if(mysqli_num_rows($findresult) >= 1) {
        //Storing filtered data
        $info = mysqli_fetch_array($findresult);
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
        $compNotes = stripslashes($info['completionNotes']);
        $appvNotes = stripslashes($info['approvalNotes']);
        //Displaying detailed reportManager & maintance only buttons and notes. 
        echo"
        <h1 style='padding-top: 2em;'>Maintenance Details</h1><hr>
        <table>
            <tr>
                <th><b>Title</b></th> 
                <td colspan='2' style='border-top:none'>".$request_title."</td>
            </tr>
            <tr>
                <th><b>Priority</b></th><th><b>Status</b></th><th><b>Employee</b></th>
            <tr>
                <td>".choosePriority($priority)."</td><td>".$status."</td><td>".$fName." ".$lName."</td>
            </tr>
            <tr>
                <th><b>Request Date</b></th><th>Approval Date</th><th>Completion Date</b></th>
            </tr><tr>
               <td>".$reqDate."</td><td>".$appvDate."</td><td>".$compDate."</td>
            </tr>
            <tr>
                <th><b>Site</th><th colspan='2'>Program</b></th>
            </tr>
            <tr>
                <td>".$site_name."</td><td colspan='2'>".$program."</td>
            </tr>
        </table>
        <form action='' method='POST'><input type=hidden value='".$_POST['id']."' name='id'>
        <h3>Description: </h3><p>".$description."</p>
        <h3>Approval Notes:</h3>
        <textarea  style = 'resize:none; width:100%px;height:100px;' name='appNotes'>".$appvNotes."</textarea>";
        if($_COOKIE['auth'] == 3){
            echo "<select id='selectPriority' name='detailPriority' style='padding:5px'>
      <option value=".$priority.">Change Priority 
      <option value='3'>High
      <option value='2'>Medium
      <option value='1'>Low
    </select> <input type='submit' value='Approve' name='approve'> <input type='submit' value='Cancel' name='cancel'> <input type='submit' value='Delete' name='delete' style='float:right'>";}
        echo"
        <h3>Completion Notes:</h3>
        <textarea  style = 'resize:none; width:100%px;height:100px;' name='comNotes'>".$compNotes."</textarea>";
         
        $detailsForm;
        if($_COOKIE['auth'] == 2 || $_COOKIE['auth'] == 3){
            echo "<input type='submit' value='Start' name='start'> <input type='submit' value='Complete' name='complete'>"; }
        echo "</form>";
    }
}
[/insert_php]
