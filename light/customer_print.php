<?php
include "connect.php";
if($_GET['type']=="E")
{
header("Content-type: application/vnd.ms-xls");
$name='Customer_Report'.'_'.time().'.xls';
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
    <title>Customer report</title>

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
    <h4><b>Customer Report:</b></h4>
                        <table border="1" width="100%" rules="all">
                                <thead>
                                <tr style="text-align:center;">
                                    <th> Acc No </th>
                                    <th> Date </th>
                                    <th> Name </th>
                                    <th> Address </th>
                                    <th> Contact </th>
                                    <th> Loan amount </th>
                                    <th> Loan Rate</th>
                                    <th> Total Loan</th>
                                    <th> Monthly EMI</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    
                                    $sql="select * from customer";
                                    //$sql= "SELECT `acc_no`,`name`,`mob_no`,`loan_amount`,`total_loan`,`city`,`district` FROM `customer`";
                                    $result=mysqli_query($link,$sql);
                                      while($row=mysqli_fetch_array($result)){
                                      ?>	  
                                      <tr>
                                        <td><?php echo $row['acc_no']; 
                                            
                                             if($row['wh_back']=="Yes"){ ?><span class="btn-inner--icon"><span class="btn-inner--icon"> <i class="fa fa-truck"></i></span></span> <?php }
                                            
                                            ?></td>
                                        <td><?php echo $row['loan_date']; ?></td>  
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['mob_no']; ?></td>
                                        <td><?php echo $row['loan_amount']; ?></td>
                                        <td><?php echo $row['loan_rate']; ?></td>
                                        <td><?php echo $row['total_loan']; ?></td>
                                        <td><?php echo $row['emi']; ?></td>
                                       <?php  }
                                      ?>
                                  </tr>
                                </tbody>    
                                </table>
<script>
    window.print();
</script>
</html>