<?php
include "connect.php";
if($_GET['type']=="E")
{
header("Content-type: application/vnd.ms-xls");
$name='Withhold_Report'.'_'.time().'.xls';
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
    <title>WithHold report</title>

    <link rel="stylesheet" href="../assets/vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendor/fontawesome/css/font-awesome.min.css">
<!--    <link rel="stylesheet" href="../assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">-->
    <link rel="stylesheet" href="../assets/css/main.css" type="text/css">
    
      <!-- DataTables -->
      <link rel="stylesheet" href="datatable/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="datatable/responsive.bootstrap4.min.css">
</head>
    <h4><b>WithHold Vehicle Customer List:</b></h4>
    <table border="1" width="100%" rules="all">
        <thead>
            <tr style="text-align:center;">
                <th> Acc no. </th>
                <th> Date </th>
                <th> Name </th>
                <th> Address</th>
                <th> Contact </th>
                <th> Loan amount </th>
                <th> Reg no. </th>
                <th> Chassis no. </th>    
            </tr>
        </thead>
        <tbody>
            <?php 
                                    
                $sql1="select * from customer WHERE `wh_back`='Yes' ";    
                $result=mysqli_query($link,$sql1);
                    while($row=mysqli_fetch_array($result)){
                    ?>	  
                    <tr>
                        <td><?php echo $row['acc_no']; ?></td>
                        <td><?php echo $row['loan_date']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['mob_no']; ?></td>
                        <td><?php echo $row['loan_amount']; ?></td>
                        <td><?php echo $row['vehicle_reg_no']; ?></td>
                        <td><?php echo $row['chassis_no']; ?></td>
                    <?php  }
                    ?>
                    </tr>
        </tbody>    
    </table>
<script>
    window.print();
</script>
    
    
</html>    