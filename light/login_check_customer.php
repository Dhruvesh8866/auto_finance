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
 $accno=$_POST['accno'];
 $phoneno=$_POST['phoneno'];
 $sql="SELECT `acc_no`,`mob_no`  FROM `customer` WHERE acc_no='$accno' and mob_no='$phoneno'";
 $result=mysqli_query($link,$sql);
	
if(mysqli_affected_rows($link)>0)
{       
    header('Location:customer_home.php');
    $_SESSION['accno'] = $accno;
}
else{
	$_SESSION['ermsg']="Invalid Credentials";
	header('Location:customer_login.php');
}
?>
<body>
</body>
</html>