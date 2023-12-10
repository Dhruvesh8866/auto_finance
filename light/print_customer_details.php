<?php
include "connect.php";
$acc=$_GET['val'];

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
    <title>Customer info</title>

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
    <h3>Logo</h3>
    <h3>Auto Finance</h3>
    <table width="100%">
        <tr>
            <td width="50%">Account Number: <?php echo $row['acc_no'];?></td>
            <td width="50%"></td>
        </tr>
        <tr>
            <td>Customer Name: <?php echo $row['name'];?></td>
            <td>Loan Date: <?php echo date('d-m-Y',strtotime($row['loan_date'])); ?></td>
        </tr>
        <tr>
            <td>Address: <?php echo $row['address'];?></td>
            <td>First EMI Date: <?php echo date('d-m-Y',strtotime($row['first_emi_date'])); ?></td>
        </tr>
    </table>
    
    <table width="100%" border="1" rules="all" cellspacing="5" cellpadding="10">
        <tr>
            <td width="50%"><b>Vehicle Model:</b></td>
            <td width="50%"><?php echo $row['model'];?></td>
        </tr>
         <tr>
            <td><b>Vehicle Amount:</b></td>
            <td><?php echo $row['vehicle_amount'];?></td>
        </tr>
        <tr>
            <td><b>Loan Amount:</b></td>
            <td><?php echo $row['loan_amount'];?></td>
        </tr>
         <tr>
            <td><b>Total Loan:</b></td>
            <td><?php echo $row['total_loan'];?></td>
        </tr>
        <tr>
            <td><b>EMI Amount:</b></td>
            <td><?php echo $row['emi'];?></td>
        </tr>
        <tr>
            <td><b>No. of EMI:</b></td>
            <td><?php echo $row['loan_month'];?></td>
        </tr>
    </table>
    <table width="100%" cellpadding="10">
    <tr>
        <td></td>
        <td></td>
    </tr>    
    <tr>
        <td width="50%"><b>Financer Sign</b></td>
        <td width="50%" align="right"><b>Customer Sign</b></td>
    </tr>
    </table>
    
    <hr>
    
    <h3>Logo</h3>
    <h3>Auto Finance</h3>
    <table width="100%">
        <tr>
            <td width="50%">Account Number: <?php echo $row['acc_no'];?></td>
            <td width="50%"></td>
        </tr>
        <tr>
            <td>Customer Name: <?php echo $row['name'];?></td>
            <td>Loan Date: <?php echo date('d-m-Y',strtotime($row['loan_date'])); ?></td>
        </tr>
        <tr>
            <td>Address: <?php echo $row['address'];?></td>
            <td>First EMI Date: <?php echo date('d-m-Y',strtotime($row['first_emi_date'])); ?></td>
        </tr>
    </table>
    
    <table width="100%" border="1" rules="all" cellspacing="5" cellpadding="10">
        <tr>
            <td width="50%"><b>Vehicle Model:</b></td>
            <td width="50%"><?php echo $row['model'];?></td>
        </tr>
         <tr>
            <td><b>Vehicle Amount:</b></td>
            <td><?php echo $row['vehicle_amount'];?></td>
        </tr>
        <tr>
            <td><b>Loan Amount:</b></td>
            <td><?php echo $row['loan_amount'];?></td>
        </tr>
         <tr>
            <td><b>Total Loan:</b></td>
            <td><?php echo $row['total_loan'];?></td>
        </tr>
        <tr>
            <td><b>EMI Amount:</b></td>
            <td><?php echo $row['emi'];?></td>
        </tr>
        <tr>
            <td><b>No. of EMI:</b></td>
            <td><?php echo $row['loan_month'];?></td>
        </tr>
    </table>
    <table width="100%" cellpadding="10">
    <tr>
        <td></td>
        <td></td>
    </tr>    
    <tr>
        <td width="50%"><b>Financer Sign</b></td>
        <td width="50%" align="right"><b>Customer Sign</b></td>
    </tr>
    </table>
    
<script>
    window.print();
</script>    
</html>