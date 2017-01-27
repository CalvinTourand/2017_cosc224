	<!DOCTYPE html>
<html>
<body>
Filter by: 
<span>
<select  id="selectSite" onchange="changeSite()"> 
  <option value="None">Site 
  <option value="Site1">Site1
  <option value="Site2">Site2
  <option value="Site3">Site3
  <option value="Site4">Site4
</select>
</span>

<span>
<select id="selectStatus" onchange="changeStatus()">  
  <option value="None">Status 
  <option value="Completed">Completed
  <option value="notCompleted">Not Completed
  <option value="notYetApproved">Not Yet Approved
</select>
</span>

<span>
<select id="selectPriority" onchange="changePriority()">  
  <option value="None">Priority  
  <option value="High">High
  <option value="Medium">Medium
  <option value="Low">Low
</select>
</span>

<span>
<!-- Request Date -->
<input  type="date" data-date-inline-picker="true" />
</span>

<span>
<!-- Approve Date -->
<input  type="date" data-date-inline-picker="true" />
</span>

<span>
<!-- Completed Date -->
<input type="date" data-date-inline-picker="true" />
</span>

<p id="demo"></p>


<script>
function changeMenuOne() {
    var oneVar = document.getElementById("selectMenuOne").value;
    document.getElementById("demo").innerHTML = "You selected: " + oneVar;
}
</script>

</body>
</html>


