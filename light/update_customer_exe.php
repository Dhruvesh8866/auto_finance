<?php
include "connect.php";


$ctr_address=$_REQUEST['ctr_address'];
$ctr_contact=$_REQUEST['ctr_contact'];
$birthday=$_REQUEST['birthday'];
$city=$_REQUEST['city'];
$district=$_REQUEST['district'];
$pincode=$_REQUEST['pincode'];

$v_reg_no=$_REQUEST['v_reg_no'];
$ch_no=$_REQUEST['ch_no'];
$eng_no=$_REQUEST['eng_no'];
$model=$_REQUEST['model'];
$other=$_REQUEST['other'];
$showroom=$_REQUEST['showroom'];
$gtr_name=$_REQUEST['gtr_name'];
$gtr_address=$_REQUEST['gtr_address'];
$gtr_contact=$_REQUEST['gtr_contact'];


$vehicle_amount=$_REQUEST['vehicle_amount'];
$downpayment=$_REQUEST['downpayment'];

echo $id=$_GET['id'];


$sql="UPDATE `customer` SET `address`='$ctr_address',`mob_no`='$ctr_contact',`vehicle_reg_no`='$v_reg_no',`chassis_no`='$ch_no',`engine_no`='$eng_no',`model`='$model',`other`='$other',`gtr_name`='$gtr_name',`gtr_address`='$gtr_address',`gtr_contact`='$gtr_contact',`city`='$city',`district`='$district',`birthday`='$birthday',`pincode`='$pincode',`vehicle_amount`='$vehicle_amount',`downpayment`='$downpayment' WHERE acc_no='$id'";
mysqli_query($link,$sql);

if(mysqli_affected_rows($link)>0)
{
    header('Location:customers.php');
	$_SESSION['success']='Customer updated Successfully...';
}
else
{
    header('Location:customers.php');
	$_SESSION['fail']='Failed to update customer...';
    
}

?>