<style>
table {border-collapse: collapse;
    width: 100%;}
th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid black;}
</style>

<?php
$mysqli = mysqli_connect("localhost", "vwts_dbman1", 'p0]K,S5Tm,7U', "vwts_wpdb1");
$sql = "SELECT reqTitle, priority,
    program, site, description, 
    reqDate, approvalDate, completionDate, status, username, reqID
    FROM requests";
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

echo"
    <h1>Maintenance Request</h1>
    <button>Request Maintenance Form</button>

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
        </tr>";

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
        echo "
            <tr>
                <td>".$request_title."</td>
                <td>".$priority."</td>
                <td>".$site_name."</td>
                <td>".$program."</td>
                <td>".$request_date."</td>
                <td>".$approval_date."</td>
                <td>".$finished_date."</td>
                <td>".$status."</td>
                <td><button onclick='myFunction()'>Click Me!</button></td>
            </tr>
            <script>
                function myFunction() {
                    alert('".$description."');
                }
            </script>";
    }
}
echo "</table>";
>