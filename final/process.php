<?php

// Include connection file
include("config.php");

//$result = array();

// Define variables to set empty values
$name = $email = $gender = $phone =  $pass = $cpass =  $select =  $comment = $web = $emailid[] = "";


$name = $_POST['name'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$pass = $_POST['pass'];
$comment = $_POST['comment'];
$select = $_POST['select'];
$url = $_POST['web'];


$result['name']=$name;
$result['email']=$email;
$result['gender']=$gender;
$result['phone']=$phone;
$result['pass']=$pass;
$result['comment']=$comment;
$result['select']=$select;
$result['url']=$url;

$sql = "INSERT INTO register (Name,Email,Gender,Phone,Password,Comment,Course,Url) VALUES('".$name."','".$email."','".$gender."','".$phone."','".$pass."','".$comment."','".$select."','".$url."')";
$row=mysql_query($sql);
// echo mysql_error();
if($row>0)
    {
		$result['status'] = 1;
		$result['message'] = "Your data inserted successfully";
		echo json_encode($result);
	}
else
	{
		$result['status'] = 0;
		$result['message'] = "Error:Try again later";
		echo json_encode($result);
	}

?>