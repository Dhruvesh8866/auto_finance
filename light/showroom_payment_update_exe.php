<?php
include "connect.php";
$v_amount=$_REQUEST['v_amount'];
$remarks=$_REQUEST['remarks'];
$type1=$_REQUEST['type1'];
$c_number=$_REQUEST['c_number'];
$c_date=$_REQUEST['c_date'];

$id=$_GET['id'];



$sql="UPDATE `showroom_payment` SET `amount`='$v_amount', `other`='$remarks', `type`='$type1', `cheque_no`='$c_number', `cheque_date`='$c_date' where `sh_payid`='$id'";

mysqli_query($link,$sql);

if(mysqli_affected_rows($link)>0)
{
	header('Location:showroom_payment.php');
	$_SESSION['success']='Record updated Successfully...';
	
	}
else{
	header('Location:showroom_payment.php');
	$_SESSION['fail']='Failed to update record...';
		
	}
?>