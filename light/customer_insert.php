<?php
session_start();

include "connect.php";

$acc_no=$_REQUEST['acc_no'];
$ctr_name=$_REQUEST['ctr_name'];
$ctr_address=$_REQUEST['ctr_address'];
$ctr_contact=$_REQUEST['ctr_contact'];
$loan_amount=$_REQUEST['loan_amount'];
$loan_month=$_REQUEST['loan_month'];
$loan_rate=$_REQUEST['loan_rate'];
$emi=$_REQUEST['emi'];
$emi_capital=$_REQUEST['emi_capital'];
$emi_interest=$_REQUEST['emi_interest'];
$file_charge=$_REQUEST['file_charge'];
$fine=$_REQUEST['fine'];
$total_loan=$_REQUEST['total_loan'];
$loan_date=$_REQUEST['loan_date'];
$first_emi_date=$_REQUEST['first_emi_date'];
$v_reg_no=$_REQUEST['v_reg_no'];
$ch_no=$_REQUEST['ch_no'];
$eng_no=$_REQUEST['eng_no'];
$model=$_REQUEST['model'];
$other=$_REQUEST['other'];
$showroom=$_REQUEST['showroom'];
$gtr_name=$_REQUEST['gtr_name'];
$gtr_address=$_REQUEST['gtr_address'];
$gtr_contact=$_REQUEST['gtr_contact'];

//$gtr_document=$_REQUEST['gtr_document'];
$gtr_document=$_FILES['gtr_document']['name'];
$path="upload/".$gtr_document;
move_uploaded_file($_FILES['gtr_document']['tmp_name'],$path);
$city=$_REQUEST['city'];
$district=$_REQUEST['district'];
$birthday=$_REQUEST['birthday'];
$pincode=$_REQUEST['pincode'];
$vehicle_amount=$_REQUEST['vehicle_amount'];
$downpayment=$_REQUEST['downpayment'];
//echo "INSERT INTO `customer`(`acc_no`, `name`, `address`, `mob_no`, `loan_amount`, `loan_month`, `loan_rate`, `emi`,`emi_capital`,`emi_interest`, `file_charge`, `fine`, `total_loan`, `loan_date`, `first_emi_date`, `vehicle_reg_no`, `chassis_no`, `engine_no`, `model`, `other`,`showroom`, `gtr_name`, `gtr_address`, `gtr_contact`, `gtr_document`, `city`, `district`, `birthday`, `pincode`, `vehicle_amount`, `downpayment`) VALUES ('$acc_no','$ctr_name','$ctr_address','$ctr_contact','$loan_amount','$loan_month','$loan_rate','$emi','$emi_capital','$emi_interest',$file_charge','$fine','$total_loan','$loan_date','$first_emi_date','$v_reg_no','$ch_no','$eng_no','$model','$other','$showroom','$gtr_name','$gtr_address','$gtr_contact','$gtr_document','$city','$district','$birthday','$pincode','$vehicle_amount','$downpayment');";

$sql="INSERT INTO `customer`(`acc_no`, `name`, `address`, `mob_no`, `loan_amount`, `loan_month`, `loan_rate`, `emi`,`emi_capital`,`emi_interest`, `file_charge`, `fine`, `total_loan`, `loan_date`, `first_emi_date`, `vehicle_reg_no`, `chassis_no`, `engine_no`, `model`, `other`,`showroom`, `gtr_name`, `gtr_address`, `gtr_contact`, `gtr_document`, `city`, `district`, `birthday`, `pincode`, `vehicle_amount`, `downpayment`) VALUES ('$acc_no','$ctr_name','$ctr_address','$ctr_contact','$loan_amount','$loan_month','$loan_rate','$emi','$emi_capital','$emi_interest','$file_charge','$fine','$total_loan','$loan_date','$first_emi_date','$v_reg_no','$ch_no','$eng_no','$model','$other','$showroom','$gtr_name','$gtr_address','$gtr_contact','$gtr_document','$city','$district','$birthday','$pincode','$vehicle_amount','$downpayment');";

mysqli_query($link,$sql);


if(mysqli_affected_rows($link)>0)
{
    for($j=0;$j<$_POST['loan_month'];$j++) {

        $date1=date('Y-m-d',strtotime('+'.$j.' Month '.$_POST['first_emi_date']));
            // $date2=date('Y-m-d',strtotime($date1));

        mysqli_query($link,"INSERT INTO `cust_inst_record`(`acc_no`, `inst_no`, `inst_date`,`emi`) VALUES('$acc_no','".($j+1)."','$date1','$emi')");

    }
    
    // to insert customer documents in document table
    mysqli_query($link,"INSERT INTO `document` (`acc_no`,`doc_name`) VALUES('$acc_no','$gtr_document')");
    
    //to insert welcome message in sms table
    list($wel_sms,$wel_sent)=mysqli_fetch_array(mysqli_query($link,"SELECT `wel_sms`,`wel_sent` FROM `pre_sms` WHERE id='1' "));
    
    if($wel_sent=="Yes"){
        $sms=str_replace('[NAME]',$_POST['ctr_name'],$wel_sms);
        $sms=str_replace('[FILE]',$_POST['acc_no'],$sms);
        $sms=str_replace('[INST]',$_POST['emi'],$sms);
        $message=str_replace('[AMT]',$_POST['total_loan'],$sms);
        
         mysqli_query($link,"INSERT INTO `sms`( `sms`, `mob_no`, `status`,`created`) VALUES ('$message','".trim($_POST['ctr_contact'])."','N',NOW())");
        
    }
    
    
	header('Location:add_customer.php');
    $_SESSION['success']='New customer added Successfully...';
	
}
else{
    header('Location:add_customer.php');
    $_SESSION['fail']='Failed to add new customer...';
	//header('Location:pro2.php');
	//$_SESSION['msg']="<font color='#FF0000'>Failed to add record...</font>";
}

?>