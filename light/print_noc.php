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
    <title>NOC Letter</title>

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
    <table width="100%" cellspacing="5" cellpadding="5"  style="border-top:1px dotted black;border-bottom:1px solid black;">
        <tr>
            <td width="33%"></td>
            <td width="33%"></td>
            <td width="33%"> Date: <?php echo date('d-m-Y'); ?> </td>
        </tr>
        <tr>
            <td>To,<br>The Regitered Officer,<br>R.T.O / Insurance Company,<br>Gujarat.</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3">This is to state that we have no objection to transfer the ownership and removal of our HPA from vehicle</td>
        </tr>
        <tr>
            <td colspan="2">Engine Number: <u><b><?php echo $row['engine_no']; ?></b></u> & Chassis Number: <u><b><?php echo $row['chassis_no']; ?></b></u></td>
            <td></td>
        </tr>
        <tr>
            <td>Registration Number: <u><b><?php echo $row['vehicle_reg_no'];?></b></u></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">Registered Owner: <u><b><?php echo $row['name'];?></b></u></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="2">For,<br>Auto Finance</td>
            <td></td>
        </tr>
       
    </table>
    <h3>AUTHORIZED SIGNATORY</h3>
    <table width="100%" cellspacing="5" cellpadding="5">
    <tr>
        <td width="50%"><b>Notes:-</b></td>
        <td width="50%"></td>
    </tr>    
    <tr>
        <td colspan="2">1. This certificate is valid only for 90 (ninety) days from the date of issue.</td>
        </tr>
    <tr>
        <td width="50%"><u>CC -</u><br>
                <b><?php echo $row['name'];?></b><br>
                City : <?php echo $row['city'];?><br>
                District : <?php echo $row['district'];?></td>
        <td width="50%"></td>
        </tr>    
    </table>
    
<script>
    window.print();
</script>    
</html>