<?php
include "connect.php";

session_start();
if(!$_SESSION['username'])
	header('Location:login.php');


 $acc=$_GET['acc_no'];
 $inst=$_GET['inst'];
// $emi_date=$_GET['edate'];
$emi_date=date('Y-m-d',strtotime($_GET['edate']));


$sql="UPDATE `cust_inst_record` SET `inst_clear`='No' WHERE `acc_no`='$acc' and `inst_date`='$emi_date'";
mysqli_query($link,$sql);
if(mysqli_affected_rows($link)>0)
{
    $sql1="DELETE FROM `payment` WHERE `acc_no`='$acc' and `inst_no`='$inst'";
    mysqli_query($link,$sql1);
    if(mysqli_affected_rows($link)>0)
    {
        	header("Location:customer_payment.php?customer=$acc");
    }
    else{
        	echo "error";	

    }
}
else
{
	echo "error";	
}





?>
