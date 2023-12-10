<?php
session_start();
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logn check</title>
</head>
    
<?php
 $username=$_POST['username'];
 $password=$_POST['password'];
 $sql="SELECT `username`,`password`  FROM `admin` WHERE username='$username' and password='$password'";
 mysqli_query($link,$sql);
//if($username =='admin' && $password =='admin123')
//{
	if(mysqli_affected_rows($link)>0)
{
		header('Location:dashboard.php');
		$_SESSION['username'] = $username;
	}
	
else{
	$_SESSION['ermsg']="Please Enter Valid Username and Password!....";
    
	header('Location:login.php');

	
		
		}
?>
<body>
</body>
</html>