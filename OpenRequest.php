<style>
  select {padding:5px}
</style>
<h1><strong>Maintenance Request Form</strong></h1>

[insert_php]
session_start();
unset($_SESSION['sql']);
if(!isset($_COOKIE['username'])){
    $_SESSION['LogError'] = "Session has timed out";
    header('location: http://vwts.ca/employeelogin');
}

if(isset($_POST['title']) && $_POST['priority'] != "None" && $_POST['site'] != "None" && $_POST['program'] != "None"){
    $prio = changePriority($_POST['priority']);
    $mysqli = mysqli_connect('localhost', 'vwts_dbman1', 'p0]K,S5Tm,7U', 'vwts_wpdb1'); 
    $sql = "INSERT INTO requests VALUES(NULL, '".$_COOKIE['username']."', '".$_POST['title']."', '".$prio."', '".$_POST['program']."', '".$_POST['site']."', '".$_POST['description']."', SYSDATE(), NULL, NULL, NULL, NULL, 'Pending')";
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
$to = "Brooke.M@vwts.ca, Micki.M@vwts.ca, Ninke.Beeksma@vwts.ca";
$subject = "Notice: New Maintenance Request - ".$_POST['title'];
$msg= "Hello Administrator, \n\n";
$msg.= "A new maintenance request was created and is in need of your consideration. The details of the request are bellow. \n\n";
$msg.= "Title: ".$_POST['title']."\n";
$msg.= "User: ".$_COOKIE['username']."\n\n";
$msg.= "To Approve or Deny deny the request, go to the Queue page or follow the link bellow: \n";
$msg.= "http://vwts.ca/employeelogin";
$headers = "To: Brooke.M@vwts.ca, Micki.M@vwts.ca, Ninke.Beeksma@vwts.ca \r\n From: teamVWT@gmail.com";
mail($to,$subject,$msg,$headers);

header('location: http://vwts.ca/employeelogin/requestqueue/');
}elseif(isset($_POST['submit'])){
  echo "<h2>Please complete all fields before submitting</h2>";
}

function changePriority($prio){
    switch($prio){
        case "Low":
        return 1;
        break;
        case "Medium":
        return 2;
        break;
        case "High":
        return 3;
        break;
    }
    return 1;
}
[/insert_php]

<hr />

<form action="" method="POST" action=""><strong><strong> <!-- Container for Left side of form --></strong></strong>

Title:
<input type="text" maxlength="40" name="title" required>

Priority:
<select name="priority">
  <option value="None">Select a Priority</option>
  <option value="Low">Low</option>
  <option value="Medium">Medium</option>
  <option value="High">High</option>
</select>

Locations:
<select name="site">
  <option value="None">Select a Location</option>
  <option value="Transition House">Transition House</option>
  <option value="Casimir Court">Casimir Court</option>
  <option value="46th Avenue">46th Avenue</option>
  <option value="Armstrong">Armstrong</option>
  <option value="Courthouse">Courthouse</option>
  <option value="Creekside">Creekside</option>
</select>

Program:
<select name="program">
  <option value="None">Select a Program</option>
  <option value="Transition House">Transition House</option>
  <option value="Support to Young Parents">Support to Young Parents</option>
  <option value="Casimir Court">Casimir Court</option>
  <option value="Oak Centre">Oak Centre</option>
  <option value="Administration">Administration</option>
  <option value="Children Who Witness Abuse – Vernon">Children Who Witness Abuse – Vernon</option>
  <option value="Children Who Witness Abuse – Armstrong">Children Who Witness Abuse – Armstrong</option>
  <option value="Stopping the Violence – Vernon">Stopping the Violence – Vernon</option>
  <option value="Stopping the Violence – Armstrong">Stopping the Violence – Armstrong</option>
  <option value="Outreach">Outreach</option>
  <option value="Specialized Victim Assistance">Specialized Victim Assistance</option>
  <option value="Homelessness Prevention">Homelessness Prevention</option>
  <option value="Legal Services Community Partner">Legal Services Community Partner</option>
  <option value="Prevention & Awareness">Prevention &amp; Awareness</option>
  <option value="Other">Other</option>
</select>

Description:
<textarea name="description"></textarea>

<!-- Reset and Submit buttons -->
<input type="reset" /> <input name="submit" type="submit" />
<a href="REQUESTQUEUE">Back</a>
</form>
