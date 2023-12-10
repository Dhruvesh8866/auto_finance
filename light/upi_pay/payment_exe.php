<?php include"../connect.php"; 

//mysqli_query($link,"INSERT INTO `payment`(`b_id`,`amount`,`pay_type`, `pay_date`,`oderid`,`b_name`,`email`,`mobile`) VALUES ('".$_SESSION['ref_id']."','1200','online',NOW(),'".$_GET['orderid']."','".$_GET['name']."','".$_GET['email']."','".$_GET['mobile']."')");

mysqli_query($link,"INSERT INTO `temp`(`acc_no`,`inst_no`,`orderid`) VALUES ('".$_GET['acc_no']."','".$_GET['inst_no']."','".$_GET['orderid']."')");

//echo 'https://www.greencircletechnology.com/gateway/index.php?orderid='.$_GET['orderid'].'&name='.$_GET['name'].'&mobile='.$_GET['mobile'].'&email='.$_GET['email'].'&amount='.$_GET['amount'];
//exit;


header('Location:https://www.greencircletechnology.com/gateway/index.php?orderid='.$_GET['orderid'].'&name='.$_GET['name'].'&mobile='.$_GET['mobile'].'&email='.$_GET['email'].'&amount='.$_GET['amount']);

?>
