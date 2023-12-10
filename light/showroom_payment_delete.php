<?php
include "connect.php";

$id=$_GET['id'];
$sql="DELETE FROM `showroom_payment` WHERE `sh_payid`=$id";
mysqli_query($link,$sql);
if(mysqli_affected_rows($link)>0)
{
	header("Location:showroom_payment.php");
}
else
{
	echo "error";	
}

?>