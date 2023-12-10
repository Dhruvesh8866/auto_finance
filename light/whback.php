<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');
include "connect.php";

$id=$_GET['id'];
//$sql="DELETE FROM `customer` WHERE `acc_no`=$id";
$sql="UPDATE `customer` SET `wh_back`='No' WHERE `acc_no`=$id";
mysqli_query($link,$sql);
if(mysqli_affected_rows($link)>0)
{
	header("Location:withhold.php");
    $_SESSION['back']='Success! Vehicle returned Successfully...';

}
else
{
	echo "error";	
}

?>