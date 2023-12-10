<?php
include "connect.php";
$acc=$_GET['acc'];

$sql="select * from customer where acc_no=$acc";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_array($result);

?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="ThemeMakker">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>HP Print</title>

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
        <center><h2>Auto Finance</h2>Shri Arcade, Deesa Highway, Palanpur</center>

    <table width="100%" cellspacing="5" cellpadding="5" style="border-top:1px dotted black;font-size:18px;">
        <tr>
            <td width="33%"></td>
            <td width="33%"></td>
            <td width="33%">Date: <?php echo date('d-m-Y',strtotime($row['loan_date'])); ?></td>
        </tr>
        <tr>
            <td>To,<br>The Regitered Officer,<br>R.T.O,<br>Gujarat.</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center;"><h3>Subject: To add HP in vehicle</h3></td>
        </tr>
        <tr>
            <td colspan="3">Due respect, we want to inform you that we own one company named Auto Finance.So, we request you to add our HP in vehicle. </td>
        </tr>
        <tr>
            <td colspan="2"><b>Vehicle Owner:</b> <?php echo $row['name']; ?></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"><b>Vehicle Number:</b>  <?php echo $row['vehicle_reg_no']; ?></td>
            <td><b>Model:</b> <?php echo $row['model']; ?></td>
        </tr>
        <tr>
            <td colspan="2"><b>Chassis Number:</b>  <?php echo $row['chassis_no']; ?></td>
            <td></td>
        </tr>
       
        <tr>
            <td></td>
            <td></td>
            <td>For,<br> Auto Finance</td>
        </tr>
    </table>
    
    
<script>
    window.print();
</script>    
</html>