<?php
session_start();

include "connect.php";


$acc_no=$_REQUEST['acc'];
$inst=$_REQUEST['inst'];
$emi_date=$_REQUEST['emi_date'];
$paydate=$_REQUEST['paydate'];
$capital=$_REQUEST['capital'];
$interest=$_REQUEST['interest'];
$emi=$_REQUEST['emi'];
$fine=$_REQUEST['fine'];
$ptype=$_REQUEST['type1'];
$loan_clear=$_REQUEST['type3'];
$c_number=$_REQUEST['c_number'];
$c_date=$_REQUEST['c_date'];

$sql="INSERT INTO `payment`(`acc_no`,`inst_no`,`amount`,`type`,`emi_date`,`pay_date`,`fine`,`inst_clear`,`emi_capital`,`emi_interest`,`cheque_no`,`cheque_date`) VALUES ('$acc_no','$inst','$emi','$ptype','$emi_date','$paydate','$fine','Yes','$capital','$interest','$c_number','$c_date')";

mysqli_query($link,$sql);
if(mysqli_affected_rows($link)>0){

    $sql1="UPDATE `cust_inst_record` SET `inst_clear`='Yes' WHERE `acc_no`='$acc_no' and `inst_no`='$inst'";
    mysqli_query($link,$sql1);
    
    list($pay_sms,$pay_sent)=mysqli_fetch_array(mysqli_query($link,"SELECT `pay_sms`,`pay_sent` FROM `pre_sms` WHERE id='1' "));
    list($name,$contact)=mysqli_fetch_array(mysqli_query($link,"SELECT `name`,`mob_no` FROM `customer` WHERE `acc_no`='$acc_no'"));
    if($pay_sent=="Yes"){
        $sms=str_replace('[NAME]',$name,$pay_sms);
        $sms=str_replace('[FILE]',$_REQUEST['acc'],$sms);
        $sms=str_replace('[INST]',$_REQUEST['inst'],$sms);
        $sms=str_replace('[DATE]',date('d-m-y',strtotime($_REQUEST['paydate'])),$sms);
        $message=str_replace('[AMT]',$_REQUEST['emi'],$sms);
        
         mysqli_query($link,"INSERT INTO `sms`( `sms`, `mob_no`, `status`,`created`) VALUES ('$message','".trim($contact)."','N',NOW())");
        
    }
    //to add fine message in pending message
    if($fine > 0){
    list($fine_sms,$fine_sent)=mysqli_fetch_array(mysqli_query($link,"SELECT `fine_sms`,`fine_sent` FROM `pre_sms` WHERE id='1' "));
    if($fine_sent=="Yes"){
        $f_sms=str_replace('[NAME]',$name,$fine_sms);
        $f_message=str_replace('[AMT]',$_REQUEST['fine'],$f_sms);
        
         mysqli_query($link,"INSERT INTO `sms`( `sms`, `mob_no`, `status`,`created`) VALUES ('$f_message','".trim($contact)."','N',NOW())");   
    }
    }
        
        
        
        
    header("Location:customer_payment.php?customer=$acc_no");
    $_SESSION['success']='Customer Payment Successful...';

}
else{
    header("Location:customer_payment.php?customer=$acc_no");
    $_SESSION['fail']='Customer Payment Failed...';
}

?>