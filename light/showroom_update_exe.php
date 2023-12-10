<?php
include "connect.php";
$showroom_name= $_REQUEST['shw_name'];
$showroom_address=$_REQUEST['shw_address'];
$showroom_city=$_REQUEST['shw_city'];
$showroom_contact=$_REQUEST['shw_contact'];
$showroom_pincode=$_REQUEST['shw_pincode'];
$id=$_GET['id'];



$sql="UPDATE `showroom` SET `sh_name`='$showroom_name', `sh_address`='$showroom_address', `sh_city`='$showroom_city', `sh_contact`='$showroom_contact', `sh_pincode`='$showroom_pincode' where `sh_id`='$id'";

mysqli_query($link,$sql);

if(mysqli_affected_rows($link)>0)
{
	header('Location:showrooms.php');
	$_SESSION['success']='Showroom updated Successfully...';
	
	}
else{
	header('Location:showrooms.php');
	$_SESSION['fail']='Failed to update showroom...';
		
	}
?>