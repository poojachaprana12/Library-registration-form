<?php 
include("config.php");

/** Simple HTML Form using PHP 
* Validation check all required fields 
* Validation for Alphabet,numeric,max and min length,radio check,password and confirmpassword match.
* Validation message append to error field
* Add/Delete button for more attributes values
* Jquery and ajax function used for Output in Json form
* Mysql Query execute on process.php page
*/

// Define variables to set empty values
$nameErr = $emailErr = $genderErr = $phoneErr = $passErr =  $cpassErr =  $commentErr = $selectErr = $webErr = "";
$name = $email = $gender = $phone =  $pass = $cpass =  $select =  $comment = $web = $emailid[] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	//---------Name Validation--------------- 	
	if (empty($_POST["name"])) 
	{
		$nameErr = "Name is required";
	} 
	else 
	{
		$name = test_input($_POST["name"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
		{
			$nameErr = "Only letters and white space allowed"; 
		}
	}
  
	//---------Email Validation--------------- 
	if (empty($_POST["email"])) 
	{
		$emailErr = "Email is required";
	} 
	else 
	{
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
		  $emailErr = "Invalid email format"; 
		}
	}
    
	//---------Phone Validation--------------- 
	if (empty($_POST["phone"])) 
	{
		$phoneErr = "Phone number is required";
	} 
	else 
	{
		$phone = test_input($_POST["phone"]);
		// check if phone only contains letters and whitespace
		if (!preg_match("/^[0-9]{10,10}$/",$phone)) 
		{
		  $phoneErr = "Invalid phone number."; 
		}
	}

	//---------Password Validation--------------- 
	if (empty($_POST["pass"])) 
	{
		$passErr = "Password is required";
	} 
	else 
	{
		$newpass= strlen($_POST["pass"]);
		$pass = test_input($_POST["pass"]);
	    if(($newpass < 4) || ($newpass > 8))
		{
			$passErr = "Password Contain 4-8 digit";
		}
	}
  
    //---------Confirm Password Validation------ 
	if (empty($_POST["cpass"])) 
	{
		$cpassErr = "ConfirmPassword is required";
	} 
	else 
	{
		$cpass = test_input($_POST["cpass"]);
		if($pass !== $cpass)
		{
			$cpassErr = "Password not match";
		}
    }
  
	//---------Comment Validation--------------- 
	if (empty($_POST["comment"])) 
	{
		$commentErr = "Please add comment";
	} 
	else 
	{
		$comment = test_input($_POST["comment"]);
	}

	//---------Radio Button Validation--------------- 
	if (empty($_POST["gender"])) 
	{
		$genderErr = "Gender is required";
	} 
	else 
	{
		$gender = test_input($_POST["gender"]);
	}
  
    //---------Select Box Validation--------------- 
	if (empty($_POST["select"])) 
	{
		$selectErr = "Select is required";
	} 
	else 
	{
		$select = test_input($_POST["select"]);
	}
  
    //---------URL Validation--------------- 
	if (empty($_POST["web"])) 
	{
		$webErr = "Enter URL";
	} 
	else 
	{
		$web = test_input($_POST["web"]);
		// check if URL address syntax is valid
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$web)) 
		{
			$webErr = "Invalid URL"; 
		}    
	}

	$emailid=$_POST["emailid"];
  
  
	$name = $_POST['name'];
	$email = $_POST['email'];
	@$gender = $_POST['gender'];
	$phone = $_POST['phone'];
	$pass = $_POST['pass'];
	$comment = $_POST['comment'];
	$select = $_POST['select'];
	$url = $_POST['web'];
	if($name!=='' && $email!=='' && $gender!=='' && $phone!=='' && $pass!=='' && $comment!=='' && $select!=='' && $url!=='')
	{
		$sql = "INSERT INTO register (Name,Email,Gender,Phone,Password,Comment,Course,Url) VALUES('".$name."','".$email."','".$gender."','".$phone."','".$pass."','".$comment."','".$select."','".$url."')";
		$row=mysql_query($sql);
		echo mysql_error();
		if($row>0)
		{
			$result['status'] = 1;
			$result['message'] = "Your data inserted successfully";
			echo json_encode($result);
			echo "<script>alert('Your data inserted successfully');</script>";
		}
		else
		{
			$result['status'] = 0;
			$result['message'] = "Error:try again later";
			echo json_encode($result);
			
			echo "<script>alert('Error:try again later');</script>";
		}
	  
	}
}
function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
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
</div><h3 style="margin-top: 20px; margin-left: 350px;">Form With Validation Error Set On Field with Json Output</h3> 
<body>
<div id="wrapper">
	<div id="steps">
		<form name="registration" id="registration" action="" method="POST"  enctype="multipart/form-data" >
			
				<fieldset class="step">
				<div id='text'style="color:red"></div> 
                           
					<p>
						<label for="name">Name *</label>
						<input id="name" type="text" name="name" placeholder="Name"  value="<?php echo $name;?>"/>
						<span class="error"><?php echo $nameErr;?></span>
  
					</p>
					<p>
						<label for="email">Email *</label>
						<input id="email" name="email" placeholder="info@xyz.com" type="text"   value="<?php echo $email;?>"/>
						<span class="error"><?php echo $emailErr;?></span>
  
					</p>
					
					<p>  
						<label for="gender">Gender *</label>
						<input type="radio" id="gender" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female" />    &nbsp&nbsp Female &nbsp&nbsp
						<input type="radio" id="gender" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male" />     Male &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<span class="error"><?php echo $genderErr;?></span>
  
					</p>
					
					<p>
						<label for="phone">Phone *</label>
						<input id="phone" name="phone"  maxlength="10"  placeholder="e.g.1234567890" type="text" value="<?php echo $phone;?>"/>
						<span class="error"><?php echo $phoneErr;?></span>
  
					</p>
					<p>
						<label for="password">Password *</label>
						<input id="password" name="pass" type="password" placeholder="Password" value="<?php echo $pass;?>"/>
						<span class="error"><?php echo $passErr;?></span>
  
					</p>
					<p>
						<label for="confirmpassword">Confirm Password*</label>
						<input id="cpassword" name="cpass" type="password" placeholder="Confirm Password" value="<?php echo $cpass;?>"/>
						<span class="error"><?php echo $cpassErr;?></span>
  
					</p>
					<p>
						<label for="comment">Comments *</label>
						<textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
						<span class="error"><?php echo $commentErr;?></span>
  
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
						<span class="error"><?php echo $selectErr;?></span>
					</p>
					<p>
						<label for="comment">URL *</label>
						<input id="web" type="text" name="web" value="<?php echo $web;?>">
						<span class="error"><?php echo $webErr;?></span>
  
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
<!----------------Output------------------------------->		
		<?php
			$name;
			if($name!=='')
			{
			echo "<h2>Your Input:</h2>";
			echo $name;
			echo "<br>";
			echo $email;
			echo "<br>";
			echo $comment;
			echo "<br>";
			echo $web;
			echo "<br>";
			echo $gender;
			
				foreach($emailid as $a => $b)
				{ 
				
				echo $emailid[$a];
				$a+1;
				echo "<br/>";
				}
			}
		?>
<!-------------------------------------------------------->				
				
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

	
	
	