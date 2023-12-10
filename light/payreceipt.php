<?php
include "connect.php";

$acc=$_GET['accno'];
$inst=$_GET['pid'];

$sql="select * from customer where acc_no=$acc";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_array($result);

$sql1="select * from payment where acc_no=$acc and inst_no=$inst";
$result1=mysqli_query($link,$sql1);
$row1=mysqli_fetch_array($result1);
$mod = $row1['type'];

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="ThemeMakker">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Pay Receipt</title>

</head>
    <h3>Logo</h3>
    <h3>Auto Finance</h3>
    <table width="100%" cellspacing="5" cellpadding="5">
        <tr>
           <?php if($mod=='Online'){
             list($orderid)=mysqli_fetch_array(mysqli_query($link,"select `orderid` from temp WHERE `acc_no`=$acc and `inst_no`=$inst and `status`='Success'"));
                                               
            ?>
           <td width="50%">Order ID: <?php echo $orderid;?></td>
           <?php } else { ?>
            <td width="50%">Receipt no:</td>
                <?php }?>
            <td width="50%"></td>
        </tr>
        <tr>
            <td width="50%">Account Number: <?php echo $row['acc_no'];?></td>
            <td width="50%"><b>Installment no:</b> <?php echo $inst; ?> of <?php echo $row['loan_month'];?> </td>
        </tr>
        <tr>
            <td>Customer Name: <?php echo $row['name'];?></td>
            <td><b>Installment Pay Date:</b> <?php echo date('d-m-Y',strtotime($row1['pay_date'])); ?></td>
        </tr>
    </table>
    
    <table width="100%"  cellspacing="5" cellpadding="5" style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black;border-style:dashed;">
        <tr>
            <td colspan="2" style="text-align:center;"><b>Received With Thanks From:</b></td>
        </tr>
         <tr>
            <td width="50%"><b>Customer Name:</b> <?php echo $row['name'];?></td>
            <td width="50%"></td>
        </tr>
        <tr>
            <td><b>Payment Mode:</b> <?php echo $row1['type'];?></td>
            <td></td>
        </tr>
         <tr>
            <td><b>EMI Amount:</b> <?php echo $row1['amount'];?></td>
            <td><b>EMI Capital:</b> <?php echo $row1['emi_capital'];?><br>  <b>EMI Interest:</b> <?php echo $row1['emi_interest'];?> </td>
        </tr>
        <tr>
            <td><b>Remarks:</b></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        
    </table>
    <table width="100%" cellpadding="10">
    <tr>
        <td></td>
        <td></td>
    </tr>    
    <tr>
        <td width="50%"><b>Finance Sign</b></td>
        <td width="50%" align="right"><b>Customer Sign</b></td>
    </tr>
    </table>
    
    <hr>
    
    <h3>Logo</h3>
    <h3>Auto Finance</h3>
    <table width="100%" cellspacing="5" cellpadding="5">
        <tr>
            <td width="50%">Receipt no:</td>
            <td width="50%"></td>
        </tr>
        <tr>
            <td width="50%">Account Number: <?php echo $row['acc_no'];?></td>
            <td width="50%"><b>Installment no:</b> <?php echo $inst; ?> of <?php echo $row['loan_month'];?> </td>
        </tr>
        <tr>
            <td>Customer Name: <?php echo $row['name'];?></td>
            <td><b>Installment Pay Date:</b> <?php echo date('d-m-Y',strtotime($row1['pay_date'])); ?></td>
        </tr>
    </table>
    
    <table width="100%"  cellspacing="5" cellpadding="5" style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black;border-style:dashed;">
        <tr>
            <td colspan="2" style="text-align:center;"><b>Received With Thanks From:</b></td>
        </tr>
         <tr>
            <td width="50%"><b>Customer Name:</b> <?php echo $row['name'];?></td>
            <td width="50%"></td>
        </tr>
        <tr>
            <td><b>Payment Mode:</b> <?php echo $row1['type'];?></td>
            <td></td>
        </tr>
         <tr>
            <td><b>EMI Amount:</b> <?php echo $row1['amount'];?></td>
            <td><b>EMI Capital:</b> <?php echo $row1['emi_capital'];?><br>  <b>EMI Interest:</b> <?php echo $row1['emi_interest'];?> </td>
        </tr>
        <tr>
            <td><b>Remarks:</b></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        
    </table>
    <table width="100%" cellpadding="10">
    <tr>
        <td></td>
        <td></td>
    </tr>    
    <tr>
        <td width="50%"><b>Finance Sign</b></td>
        <td width="50%" align="right"><b>Customer Sign</b></td>
    </tr>
    </table>    
<script>
    window.print();
</script>    
</html>