<?php
session_start();

include "connect.php";

$shpaydate=$_REQUEST['shpaydate'];
$showroom=$_REQUEST['showroom'];
$customer=$_REQUEST['customer'];
$type1=$_REQUEST['type1'];
$v_amount=$_REQUEST['v_amount'];
$remarks=$_REQUEST['remarks'];
//echo $b_name=$_REQUEST['$b_name'];
$c_number=$_REQUEST['c_number'];
$c_date=$_REQUEST['c_date'];

$sql="INSERT INTO `showroom_payment`(`sh_id`, `acc_no`, `amount`,`type`, `cheque_no`,`cheque_date`,`pay_date`,`other`) VALUES ('$showroom','$customer','$v_amount','$type1','$c_number','$c_date','$shpaydate','$remarks')";

mysqli_query($link,$sql);

if(mysqli_affected_rows($link)>0)
{

    $_SESSION['success']='Showroom Payment Successful...';
    header('Location:showroom_payment.php');
}
else{
    $_SESSION['fail']='Showroom Payment Failed...';
    header('Location:showroom_payment.php');

}



?>