<?php 
/** Simple HTML Form using PHP 
* Validation check all required fields 
* Validation message append to error field
* Jquery and ajax function used for Output in Json form
* Mysql Query execute on process.php page
*/

// Define variables to set empty values
$nameErr = $emailErr = $genderErr = $phoneErr = $passErr =  $cpassErr =  $commentErr = $selectErr = $webErr = "";
$name = $email = $gender = $phone =  $pass = $cpass =  $select =  $comment = $web = $emailid[] = "";

?>
<html>
	<head>  
		<title>Library Form </title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

	</head>
	<style>
.error {color: #FF0000;}
</style>

<div class="wrapper col5">
	<div id="footer">
	 <br class="clear" />
  </div>
</div><h3 style="margin-top: 20px; margin-left: 350px;">Form With Empty Check Validation Set On Field with Json Output</h3> 
<body>
<div id="wrapper">
	<div id="steps">
		<form name="registration" id="registration" action="" method="POST"  enctype="multipart/form-data" >
			
				<fieldset class="step">
				<div id='text'style="color:red"></div> 
                           
					<p>
						<label for="name">Name *</label>
						<input id="name" type="text" name="name" placeholder="Name"  value="<?php echo $name;?>"/>
						<span class="error" id="error_name"></span>
  
					</p>
					<p>
						<label for="email">Email *</label>
						<input id="email" name="email" placeholder="info@xyz.com" type="text"   value="<?php echo $email;?>"/>
						<span class="error" id="error_email"></span>
  
					</p>
					
					<p>  
						<label for="gender">Gender *</label>
						<input type="radio" id="gender" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
						<input type="radio" id="gender" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
						<span class="error" id="error_gender"></span>
  
					</p>
					
					<p>
						<label for="phone">Phone *</label>
						<input id="phone" name="phone"  maxlength="10"  placeholder="e.g.1234567890" type="text" value="<?php echo $phone;?>"/>
						<span class="error" id="error_phone"></span>
  
					</p>
					<p>
						<label for="password">Password *</label>
						<input id="password" name="pass" type="password" placeholder="Password" value="<?php echo $pass;?>"/>
						<span class="error" id="error_pass"></span>
  
					</p>
					<p>
						<label for="confirmpassword">Confirm Password*</label>
						<input id="cpassword" name="cpass" type="password" placeholder="Confirm Password" value="<?php echo $cpass;?>"/>
						<span class="error" id="error_cpass"></span>
  
					</p>
					<p>
						<label for="comment">Comments *</label>
						<textarea name="comment" id="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
						<span class="error" id="error_comment"></span>
  
					</p>
					<p>
						<label for="course">Highest Course *</label>
						<select id="course" name="select">
						<option value="0" selected>---Select Any One---</option>
							<option <?php if(isset($select) && $select=="1") echo "selected";?> value="1">High School</option>
							<option  <?php if(isset($select) && $select=="2") echo "selected";?>  value="2">Intermediate</option>
							<option  <?php if(isset($select) && $select=="3") echo "selected";?>  value="3">B.Tech</option>
							<option  <?php if(isset($select) && $select=="4") echo "selected";?>  value="4">M.Tech</option>
						   
						</select>
						<span class="error" id="error_select"></span>
					</p>
					<p>
						<label for="comment">URL *</label>
						<input id="web" type="text" name="web" value="<?php echo $web;?>">
						<span class="error" id="error_url"></span>
  
					</p>
					<p> 
					
						<input type="button" style="width: 20%;" value="Add" onClick="addRow('dataTable')" /> 
						<input type="button" style="width: 20%;" value="Remove" onClick="deleteRow('dataTable')" />
						<table id="dataTable" border="0" style="margin-left: -100px;">
							<tbody>
								<tr>
                      				<td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
									<td><input type="text" placeholder="Email"  name="emailid[]" style="margin-left: -70px; "></td>
									
						        </tr>
							</tbody>
						</table>  
  
					</p>
					
					<p class="submit">
						<button id="registerButton" type="submit" value="submit" >Register</button>
						
					</p>
					
				</fieldset>
				
		</form>
		<?php
				echo "<h2>Your Input:</h2>";
				?><input type="text" name="name1" id="n"> 
				<input type="text" name="email1" id="e">
				<input type="text" name="phone1" id="p">
				
				
							
	</div>
</div>

<!-- footer start -->
<?php include("footer.php");?>
<!-- footer end -->

</body>
</html>

<script type="text/javascript">
function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 2){                            // limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i <colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		}
	}else{
		 alert("Maximum 2 Attributes");
			   
	}
}

function deleteRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
			if(rowCount <= 1) {               // limit the user from removing all the fields
				alert("Cannot Remove all .");
				break;
			}
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
}
</script>
<script type="text/javascript">
/** Jquery Function using ajax for Json Output 
*Validation for all empty fields
*Error Message set on fields
*/
jQuery(document).ready(function(){
	$('#registration').submit(function(){
		var tName = $('#name').val(); 
		if(tName == '')
		{
			$('#error_name').html("Please Enter Name");
			$( "#error_name" ).focus();
			return false;
		}
		else
		{
			$('#error_name').html("");
			
		}
		
		var tEmail = $('#email').val(); 
		if(tEmail == '')
		{
			$('#error_email').html("Please Enter Email");
			$( "#error_email" ).focus();
			return false;
		}
		else
		{
			$('#error_email').html("");
		}
		
		
		var tPhone = $('#phone').val(); 
		if(tPhone == '')
		{
			$('#error_phone').html("Please Enter Phone");
			$( "#error_phone" ).focus();
			return false;
		}
		else
		{
			$('#error_phone').html("");
		}
		
		var tPass = $('#password').val(); 
		if(tPass == '')
		{
			$('#error_pass').html("Please Enter Password");
			$( "#error_pass" ).focus();
			return false;
		}
		
		
		else
		{
			$('#error_pass').html("");
		}
		
		var tCpass = $('#cpassword').val(); 
		if(tCpass == '')
		{
			$('#error_cpass').html("Please Enter Confirm Pass");
			$( "#error_cpass" ).focus();
			return false;
		}
		else
		{
			$('#error_cpass').html("");
		}
		
		var tComment = $('#comment').val(); 
		if(tComment == '')
		{
			$('#error_comment').html("Please Enter comment");
			$( "#error_comment" ).focus();
			return false;
		}
		else
		{
			$('#error_comment').html("");
		}
		
		var tUrl = $('#web').val(); 
		if(tUrl == '')
		{
			$('#error_url').html("Please Enter Url");
			$( "#error_url" ).focus();
			return false;
		}
		else
		{
			$('#error_url').html("");
		}
		//alert($(this).serialize());
		$.post(
			"process.php",
			$(this).serialize(),
			function(data) {
				//alert(data.message);
				if (data.status == 1) {
					alert('success');
					//alert(data.email);
					$("#n").val(data.name);
					$("#e").val(data.email);
					$("#p").val(data.phone);					
				}

			},'json'
		);
		return false;
	});
});
</script>
