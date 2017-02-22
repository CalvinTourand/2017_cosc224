<html>
<body>
Request Form:
<form action="/action_page.php">
<br>
<div>
Choose site that requires maintenance:<br>
<select  id="selectSite" onchange="changeSite()"> <br>
  <option value="None">Select Site 
  <option value="Site1">Site1
  <option value="Site2">Site2
  <option value="Site3">Site3
  <option value="Site4">Site4
</select>
</div>
<br>

<div>
Choose program that requires maintenance:<br>
<select  id="selectSite" onchange="changeSite()"><br>
  <option value="None">Select Program
  <option value="Site1">Program1
  <option value="Site2">Program2
  <option value="Site3">Program3
  <option value="Site4">Program4
</select>
</div>
<br>

<div>
Choose priority of maintenance request:<br>
<select id="selectPriority" onchange="changePriority()"><br>
  <option value="None">Select Priority  
  <option value="High">High
  <option value="Medium">Medium
  <option value="Low">Low
</select>
</div>
<br>

<div>
Write title:<br>
  <input type="text" name="title"><br>
</div>
<br>

<div>
Write description:<br>
<textarea rows="4" cols="50">
</textarea>
<br>

<input type="submit" value="Submit">
</form>

<!-- Date choosers
<div>
<input  type="date" data-date-inline-picker="true" />
</div>

<div>
<input  type="date" data-date-inline-picker="true" />
</div>

<div>
<input type="date" data-date-inline-picker="true" />
</div>
-->

</body>
</html>