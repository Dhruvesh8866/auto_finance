<?php
include "connect.php";

$id=$_GET['id'];
$sql="DELETE FROM `customer` WHERE `acc_no`=$id";
mysqli_query($link,$sql);

//to delete record from document table
mysqli_query($link,"DELETE FROM `document` WHERE `acc_no`=$id");

//to delete records from customer_inst_record
mysqli_query($link,"DELETE FROM `cust_inst_record` WHERE `acc_no`=$id");
if(mysqli_affected_rows($link)>0)
{
	header("Location:customers.php");
}
else
{
	echo "error";	
}

?>