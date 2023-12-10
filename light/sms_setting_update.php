<?php
session_start();

include "connect.php";

echo $wel=$_REQUEST['type1'];
echo $due=$_REQUEST['type2'];
echo $rem=$_REQUEST['type3'];
echo $pay=$_REQUEST['type4'];
echo $fine=$_REQUEST['type5'];
echo $bday=$_REQUEST['type6'];    

echo $sql="UPDATE pre_sms SET wel_sent='$wel',due_sent='$due',reminder_sent='$rem',fine_sent='$fine',pay_sent='$pay',birth_sent='$bday'";

mysqli_query($link,$sql);

if(mysqli_affected_rows($link)>0)
{
	header('Location:message.php');
	$_SESSION['success']='SMS setting updated Successfully...';
	
	}
else{
	header('Location:message.php');
	$_SESSION['fail']='Failed to update SMS setting...';
		
	}
?>