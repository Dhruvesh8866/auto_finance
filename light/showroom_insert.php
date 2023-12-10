<?php
session_start();

include "connect.php";
$showroom_name= $_REQUEST['shw_name'];
$showroom_address=$_REQUEST['shw_address'];
$showroom_city=$_REQUEST['shw_city'];
$showroom_contact=$_REQUEST['shw_contact'];
$showroom_pincode=$_REQUEST['shw_pincode'];




$sql="INSERT INTO `showroom` (`sh_name`, `sh_address`, `sh_city`, `sh_contact`, `sh_pincode`) VALUES ('$showroom_name', '$showroom_address', '$showroom_city', '$showroom_contact', '$showroom_pincode');";

mysqli_query($link,$sql);

if(mysqli_affected_rows($link)>0)
{
	header('Location:add_showroom.php');
	$_SESSION['success']='New showroom added Successfully...';
	
	}
else{
	header('Location:add_showroom.php');
	$_SESSION['fail']='Failed to add new showroom...';
		
	}
?>