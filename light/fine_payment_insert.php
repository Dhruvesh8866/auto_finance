<?php
session_start();

include "connect.php";

echo $acc_no=$_REQUEST['acc_no'];
echo $fpaydate=$_REQUEST['fpaydate'];
echo $famount=$_REQUEST['famount'];
echo $l_clear=$_REQUEST['type2'];
echo $p_type=$_REQUEST['type1'];
echo $c_number=$_REQUEST['c_number'];
echo $c_date=$_REQUEST['c_date'];

$sql1="SELECT `acc_no` from `fine_payment` WHERE `acc_no`='$acc_no'";
mysqli_query($link,$sql1);
if(mysqli_affected_rows($link)>0)
{
        header('Location:fine_payment.php?customer='.$acc_no);
        $_SESSION['fail']='Fine Payment already done...';

}
else{
    $sql="INSERT INTO `fine_payment`(`acc_no`, `amount`, `type`, `cheq_no`, `cheq_date`, `fine_pay_date`) VALUES ('$acc_no','$famount','$p_type','$c_number','$c_date','$fpaydate')";

    mysqli_query($link,$sql);
    
    //to insert fine paid message in SMS table
    list($fine_sms,$fine_sent)=mysqli_fetch_array(mysqli_query($link,"SELECT `fine_sms`,`fine_sent` FROM `pre_sms` WHERE id='1' "));
    list($name,$contact)=mysqli_fetch_array(mysqli_query($link,"SELECT `name`,`mob_no` FROM `customer` WHERE `acc_no`='$acc_no'"));
    if($fine_sent=="Yes"){
        $sms=str_replace('[NAME]',$name,$fine_sms);
        $message=str_replace('[AMT]',$_REQUEST['famount'],$sms);
        
         mysqli_query($link,"INSERT INTO `sms`( `sms`, `mob_no`, `status`,`created`) VALUES ('$message','".trim($contact)."','N',NOW())");
        
    }


    if(mysqli_affected_rows($link)>0)
    {
        header('Location:fine_payment.php?customer='.$acc_no);
        $_SESSION['success']='Fine payment paid Successfully...';

        }
    else{
        header('Location:fine_payment.php?customer='.$acc_no);
        $_SESSION['fail']='Failed to pay fine amount...';

        }
    
}
?>

?>