<?php 
/** Simple HTML Form using PHP 
* Validation for all required fields
* Validation for Alphabet,numeric,max and min length,radio check,password and confirmpassword match.
* Validation message pop up in alert box
* Add/Delete button for more attributes values
* Jquery and ajax function used for Output in Json form
* Mysql Query execute on process.php page
*/


// Define variables to set empty values
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
</div><h3 style="margin-top: 20px; margin-left: 350px;">Form With Error in Alert Box with Json Output</h3> 

<body>
<div id="wrapper">
	<div id="steps">
		<form name="registration" id="registration" action="" method="POST"    enctype="multipart/form-data" >
			
				<fieldset class="step">
				<div id='text'style="color:red"></div> 
                           
					<p>
						<label for="name">Name <span class="error">*</span></label>
						<input id="name" type="text" name="name" placeholder="Name"  value="<?php echo $name;?>"/>
					</p>
					<p>
						<label for="email">Email <span class="error">*</span></label>
						<input id="email" name="email" placeholder="info@xyz.com" type="text"   value="<?php echo $email;?>"/>
					</p>
					<p>  
						<label for="gender">Gender <span class="error">*</span></label>
						<input type="radio" id="gender" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
						<input type="radio" id="gender" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
					</p>
					<p>
						<label for="phone">Phone <span class="error">*</span></label>
						<input id="phone" name="phone"  maxlength="10"  placeholder="e.g.1234567890" type="text" value="<?php echo $phone;?>"/>
					</p>
					<p>
						<label for="password">Password <span class="error">*</span></label>
						<input id="password" name="pass" type="password" placeholder="Password" value="<?php echo $pass;?>"/>
					</p>
					<p>
						<label for="confirmpassword">Confirm Password<span class="error">*</span></label>
						<input id="cpassword" name="cpass" type="password" placeholder="Confirm Password" value="<?php echo $cpass;?>"/>
					</p>
					<p>
						<label for="comment">Comments <span class="error">*</span></label>
						<textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
					</p>
					<p>
						<label for="course">Highest Course <span class="error">*</span></label>
						<select id="course" name="select">
						<option value="0" selected>---Select Any One---</option>
							<option <?php if(isset($select) && $select=="1") echo "selected";?> value="1">High School</option>
							<option  <?php if(isset($select) && $select=="2") echo "selected";?>  value="2">Intermediate</option>
							<option  <?php if(isset($select) && $select=="3") echo "selected";?>  value="3">B.Tech</option>
							<option  <?php if(isset($select) && $select=="4") echo "selected";?>  value="4">M.Tech</option>
						   
						</select>
					</p>
					<p>
						<label for="comment">URL <span class="error">*</span></label>
						<input id="web" type="text" name="web" value="<?php echo $web;?>">
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
						<button id="registerButton" type="submit" value="submit" onClick="return valid()">Register</button>
						
					</p>
					
				</fieldset>
				
				<?php
				echo "<h2>Your Input:</h2>";
				?>
				<input type="text" name="name1" id="n"> 
				<input type="text" name="email1" id="e">
				<input type="text" name="phone1" id="p">
				
				
				
							
		</form>
	</div>
</div>

<!-- footer start -->
<?php include("footer.php");?>
<!-- footer end -->

</body>
</html>

<script type="text/javascript">
/** Validation For All Input Fields
* Name with Alphabets only
* Phone number contain only Numbers
* Valid Email Address
* Radio Checked
* Password Length and Confirm Password Match
* Valid Url
*/

function valid()
{
	
	if(document.registration.name.value=="")
	{
		alert("please enter name");
		document.registration.name.focus();
		return false;
	}
	var  N=/^[a-z A-Z]+$/;
	if (!N.test(document.registration.name.value))
	{
		alert('not valid Name');
		document.registration.name.focus();
		return false;
	}


	var e=/^[a-zA-Z0-9._]+@.[a-zA-Z0-9,-]+\.[a-zA-Z]{2,4}$/;
	if(document.registration.email.value=="")
	{
		alert("please enter emailid");
		document.registration.email.focus();
		return false;
	}
	if (!e.test(document.registration.email.value))
	{
		alert('not valid email');
		document.registration.email.focus();
		return false;
	}

	
	if ( ( document.registration.gender[0].checked == false ) && ( document.registration.gender[1].checked == false ) )
	{
		alert ( "Please choose your Gender: Male or Female" );
		return false;
	}
   
 
	var  n=(/^[0-9]{10,10}$/);
	if(document.registration.phone.value=="")
	{
		alert("please enter mobileno");
		document.registration.phone.focus();
		return false;
	}
    if(!n.test(document.registration.phone.value))
	{
		alert("Mobileno should contain only numbers");
		document.registration.phone.focus();
		return false;
	}


	if(document.registration.password.value=="")
	{
	  alert("please enter password");
	  document.registration.password.focus();
	  return false;
	} 

	
	if ((document.registration.password.value.length < 6) || (document.registration.password.value.length > 12))
	{
	  alert("password should be greater than 6 digit");
	  document.registration.password.focus();
	  return false;
	}
	
	
	if(document.registration.cpassword.value=="")
	{
		alert("please enter confirmpassword");
		document.registration.cpassword.focus();
		return false;
	}
	if(document.registration.password.value!=document.registration.cpassword.value)
	{
		alert("sorry.password not match");
		return false;
	}
  
	if(document.registration.comment.value=="")
	{
		alert("Please Add Message");
		document.registration.comment.focus();
		return false;
	}
  
	if(document.registration.course.value=="")
	{
		alert("Please Select Course");
		document.registration.course.focus();
		return false;
	}
  
	if(document.registration.web.value=="")
	{
		alert("Please URL");
		document.registration.web.focus();
		return false;
	}
  
  	 
return true;
}




function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 2){                            // limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i <colCount; i++) {        //For Loop for row count
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
				alert("Cannot Remove all rows .");
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
/** Jquery Function using ajax for Json Output */
jQuery(document).ready(function(){
	$('#registration').submit(function(){
	//alert($(this).serialize());
	$.post(
			"process.php",
			$(this).serialize(),
			function(data) {
				//alert(data.message);
				if(data.status == 1)
				{
					alert('Success');
					$("#n").val(data.name);
					$("#e").val(data.email); 
					$("#p").val(data.phone);
				}
				elseif(data.status == 0)
				{
					alert('error');
				}
			},'json'
		);
		return false;
	});
});

</script>
	
	
	