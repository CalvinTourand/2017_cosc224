<style>
table {border-collapse: collapse;
    width: 100%;}
th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid black;}
.filterDiv  {float: left;
             padding: 5px;}
select {padding: 4px;}
</style>

<h1>Maintenance Request</h1>
<h2>Queue of requested maintenance</h2>
<hr>
<button>Request Maintenance Form</button><br>

<form>
<h3>Filter by:</h3>
    <div class='filterDiv'><h3>Site:</h3>
    <select id='selectSite'>
        <option value='Transition_House'>Transition House
        <option value='Casimir_Court'>Casimir Court
        <option value='46th_Avenue'>46th Avenue
        <option value='Armstrong'>Armstrong
        <option value='Courthouse'>Courthouse
        <option value='Creekside'>Creekside
    </select></div>
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
    <div class='filterDiv'><h3>Status:</h3>
    <select id='selectStatus'>
      <option value='None'>Status 
      <option value='Completed'>Completed
      <option value='notCompleted'>Not Completed
      <option value='notYetApproved'>Not Yet Approved
      <option value='notApproved'>Not Approved
    </select></div>
    <div class='filterDiv'><h3>Priority:</h3>
    <select id='selectPriority'>
      <option value='None'>Priority  
      <option value='High'>High
      <option value='Medium'>Medium
      <option value='Low'>Low
    </select></div>
    <!-- Request Date -->
    <div class='filterDiv'><h3>Request Date:</h3>
    <input  type='date' data-date-inline-picker='true'/></div>
    <!-- Approve Date -->
    <div class='filterDiv'><h3>Approval Date:</h3>
    <input  type='date' data-date-inline-picker='true'/></div>
    <!-- Completed Date -->
    <div class='filterDiv'><h3>Completed Date:</h3>
    <input type='date' data-date-inline-picker='true'/></div>
    <div class='filterDiv' style='padding-top:2em'><input type='button' value='Filter'></div>
</form>

<table style='border: 1px solid'>
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
$mysqli = mysqli_connect("localhost", "vwts_dbman1", 'p0]K,S5Tm,7U', "vwts_wpdb1");
$sql = "SELECT reqTitle, priority,
    program, site, description, 
    reqDate, approvalDate, completionDate, status, username, reqID
    FROM requests";
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($result) >= 1) {
    while ($info = mysqli_fetch_array($result)) {
        //Objects with these variables
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
if (isset($_GET['id'])) 
    findItem($_GET['id'], $mysqli);

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

function findItem($id, $sqli){
        $findsql = "SELECT reqTitle, priority, program, site, description, 
            reqDate, approvalDate, completionDate, status, e.fName, e.lName
            FROM requests r, employees e
            WHERE ".$_GET['id']." = reqID;";
        $findresult = mysqli_query($sqli, $findsql) or die(mysqli_error($sqli));
        if(mysqli_num_rows($findresult) >= 1) {
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
            
            echo"
            <table style='border: 1px solid'>
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
            </table>
            <h3>Notes</h3>
            <textarea cols='40' rows='3' name='notes'>Notes</textarea>
            <button value='complete'>Complete</button> <button value='approve'>Approve</button>";
        }
    }
[/insert_php]
</table>
