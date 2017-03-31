[insert_php]
session_start();
if(!isset($_COOKIE['username'])){
    $_SESSION['LogError'] = "Session has timed out";
    header('location: http://localhost/wordpress/?page_id=1938');
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
select {padding: 4px;}
</style>

<h1>Maintenance Request</h1>
<h2>Queue of requested maintenance</h2>
<hr>
<div class="filterDiv">
<!--Link to Maintenance Request Form-->
<a href=""><button>Request Maintenance Form</button></a>
<!--Link for managers to create new employee account-->
<a href="http://localhost/wordpress/?page_id=2032"><button>Create Employee Account</button></a></div>

<!--Filter by option form-->
<form method="POST">
<h3>Filter by:</h3>
    <!--Filter by sites-->
    <div class='filterDiv'><h3>Site:</h3>
    <select id='selectSite'>
        <option value='Transition_House'>Transition House
        <option value='Casimir_Court'>Casimir Court
        <option value='46th_Avenue'>46th Avenue
        <option value='Armstrong'>Armstrong
        <option value='Courthouse'>Courthouse
        <option value='Creekside'>Creekside
    </select></div>
    <!--Filter by programs-->
    <div class='filterDiv'><h3>Program:</h3>
    <select  id='selectProgram'>
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
    <select id='selectStatus'>
      <option value='None'>Status 
      <option value='Completed'>Completed
      <option value='notCompleted'>Not Completed
      <option value='notYetApproved'>Not Yet Approved
      <option value='notApproved'>Not Approved
    </select></div>
    <!--Filter by priority-->
    <div class='filterDiv'><h3>Priority:</h3>
    <select id='selectPriority'>
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
    <div class='filterDiv' style='padding-top:2em'><input type='button' style='padding: 5px' value='Filter'></div>
</form>

<!--Start of request queue-->
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
    </tr>
    
[insert_php]
//Start session for session variables
session_start();
//tableOffset to manage pages displayed on queue
$tableOffset;
$tableOffset;
if(isset($_GET['offset']) && $_GET['offset'] >= 0){
    $tableOffset = $_GET['offset'];
}else{
	$tableOffset = 0;
}

//Clearing any errors created in the Create Account Page
unset($_SESSION['CreateError']);

//Connecting to Database
$mysqli = mysqli_connect("localhost", "vwts_dbman1", 'p0]K,S5Tm,7U', "vwts_wpdb1");
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
                <td style='padding:1em'>".$request_title."</td>
                <td style='padding:1em'>".$site_name."</td>
                <td style='padding:1em'>".$program."</td>
                <td style='padding:1em'>".$priority."</td>
                <td style='padding:1em'>".$request_date."</td>
                <td style='padding:1em'>".$approval_date."</td>
                <td style='padding:1em'>".$finished_date."</td>
                <td style='padding:1em'>".$status."</td>
                <td style='padding:1em'><a href='http://localhost/wordpress/?page_id=1805&id=".$reqID."&offset=".$tableOffset."'>More Info</a></td>
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
	 <div style='text-align:right;'><a href='http://localhost/wordpress/?page_id=1805&offset=".($tableOffset-10)."'><button>Previous</button></a> <a href='http://localhost/wordpress/?page_id=1805&offset=".$tableOffsetNext."'><button>Next</button></a></div>";
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
        reqDate, approvalDate, completionDate, status, e.fName, e.lName
        FROM requests r, employees e
        WHERE ".$id." = reqID;";
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
        //Displaying detailed reportManager & maintance only buttons and notes.
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
                <td>".$fName." ".$lName."</td><td>".choosePriority($priority)."</td>
            </tr>
        </table>";
        //Manager & maintance only buttons and notes.
        echo"
            <h3>Notes</h3>
            <form action='' method='POST'>
            <textarea cols='40' rows='3' name='notes'>Notes</textarea>
            <input type='submit' value='Complete' name='complete'> <input type='submit' value='Approve' name='approve'>
            </form>";
    }
}
[/insert_php]
