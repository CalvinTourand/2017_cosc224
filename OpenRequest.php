
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
.ui-btn{opacity:1}.ui-select{ /* <!-- CSS for drop down buttons --> */
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
		
		<a href="#openRequest" data-rel="popup" data-position-to="window"> Create Maintenance Request Form</a>
		<div data-role="popup" id="openRequest" class="ui-content" style="background-color: white; position: relative; min-width:700px; min-height: 465px; z-index:991000;">
			<a href="#" data-rel="back" data-role="button" class="ui-btn-right" data-shadow = "false" style = "text-decoration: none; top:1px; right:1px;">X</a> 
			<div style = "position: absolute; width:25%; top:10%;">
				<b>Title</b></br>
				".$request_title."<br><hr>
				<b>Status</b></br>
				".$status."<hr>
				
			</div>
			<div style = "position: absolute; width:25%; top:10%; left:25%;">
				<b>Employee</b></br>
				".$fName." ".$lName."</br><hr>
				<b>Request Date</b></br>
				".$reqDate."<hr>
				
			</div>
			<div style = "position: absolute; width:25%; top:10%; left:50%;">
				<b>Site</b></br>
				".$site_name."</br><hr>
				<b>Approval Date</b></br>
				".$appvDate.<hr>
			</div>
			<div style = "position: absolute; width:25%; top:10%; left:75%;">
				<b>Program</b></br>
				".$program."</br><hr>
				<b>Completion Date</b></br>
				".$compDate."<hr>
			</div>
			
			<div style = "position: absolute; width:100%; height:22%; top:32%;">
				<b>Description</b></br>
				<textarea data-role="none" cols='70' rows='3' name='description' style ="resize:none; width:95%;height:100%"></textarea>
			</div>
			<div style = "position: absolute; width:100%; height:22%; top:60%;">
				<b>Notes</b></br>
				<textarea name='notes' data-role="none" style ="width:95%; height: 100%"></textarea>
			</div>
			<div style = "position: absolute; width:47%; top:87%;">
				<input type='submit' value='Complete' name='complete'>
			</div>
			<div style = "position: absolute; left:51%; width:47%; top:87%;">
				<input type='submit' value='Approve' name='approve'>
			</div>
			<!--
						<div style = "position: absolute; width:25%; top:10%; left:75%;">
				<b>Completion Date</b></br>
				".$compDate."
			</div>
					<th>Program</th><th>Site</th><th colspan='2'>Descripton</th>
				</tr><tr>
					<td>".$program."</td><td>".$site_name."</td><td colspan='2' rowspan='3'>".$description."</td>
				</tr><tr>
					<th>Employee</th><th>Priority</th>
				</tr><tr>
					<td>".$fName." ".$lName."</td><td>".choosePriority($priority)."</td>
				</tr>
			</table>";
			<h3>Notes</h3>

			<textarea cols='40' rows='3' name='notes'>Notes</textarea>
			<input type='submit' value='Complete' name='complete'> <input type='submit' value='Approve' name='approve'>
			
				<!-- Right side of Form
				<div style="position: absolute; left:51%; top: 17%;  width: 87%; height:65%; width: 50%;">
					Description:	
					<div style = "position: absolute; top: 7%; height:100%; width:100%;"> 
						<textarea data-role="none" name="description" style ="height: 96%; width:92%; top:10%; resize:none" ></textarea>	
					</div>	
				</div>
				<br>
				<!-- Reset and Submit buttons 
				<div style= "position: absolute;  top: 85%; width: 47%; ">
					<input type = "reset" style = "width: 100%; height:100%; border:none; background-color:transparent;"> </div>
				<div style = "position: absolute; top: 85%; width: 47%; left: 51%;">	
					<input type = "submit" style = "border:none; background-color:transparent;"></div>
			</form>
		</div>
-->
	</div>
</body>
</html>