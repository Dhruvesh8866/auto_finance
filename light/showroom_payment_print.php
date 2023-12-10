<?php
include "connect.php";

$from=$_GET['from'];
$to=$_GET['to'];

if($_GET['type']=="E")
{
header("Content-type: application/vnd.ms-xls");
$name='Showroom_Payment_Report'.'_'.time().'.xls';
header("Content-Disposition: attachment;Filename=$name");
}

?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="ThemeMakker">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Showroom Payment report</title>

<!--
    <link rel="stylesheet" href="../assets/vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendor/fontawesome/css/font-awesome.min.css">
-->
<!--    <link rel="stylesheet" href="../assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">-->
<!--
    <link rel="stylesheet" href="../assets/css/main.css" type="text/css">
    
       DataTables 
      <link rel="stylesheet" href="datatable/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="datatable/responsive.bootstrap4.min.css">
-->
</head>

<h4><b>Showroom Payment report:</b></h4>

    <table border="1" width="100%" rules="all">
                                <thead>
                                <tr>
                                    <th> No. </th>
                                    <th> Date </th>
                                    <th> Showroom </th>
                                    <th> Acc no. </th>
                                    <th> Name </th>
                                    <th> Amount </th>   
                                </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    
                                    if($from!="" && $to!=""){
                                    $sql="SELECT sp.sh_payid,sp.pay_date,sp.acc_no,sp.amount,c.name,s.sh_name FROM showroom_payment sp JOIN customer c ON sp.acc_no=c.acc_no JOIN showroom s ON sp.sh_id=s.sh_id WHERE pay_date BETWEEN '$from' AND '$to'";
                                    }
                                    else{
                                        $sql="SELECT sp.sh_payid,sp.pay_date,sp.acc_no,sp.amount,c.name,s.sh_name FROM showroom_payment sp JOIN customer c ON sp.acc_no=c.acc_no JOIN showroom s ON sp.sh_id=s.sh_id";
                                    }
                                   
                                    //$sql= "SELECT `acc_no`,`name`,`mob_no`,`loan_amount`,`total_loan`,`city`,`district` FROM `customer`";
                                    $result=mysqli_query($link,$sql);
                                      while($row=mysqli_fetch_array($result)){
                                      ?>	  
                                      <tr>
                                        <td><?php echo $row['sh_payid']; ?></td>
                                        <td><?php echo $row['pay_date']; ?></td>
                                        <td><?php echo $row['sh_name']; ?></td>
                                        <td><?php echo $row['acc_no']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['amount']; ?></td>
                                       <?php  }
                                      ?>
                                  </tr>
                                </tbody>    
                                </table>
<script>
    window.print();
</script>
</html>