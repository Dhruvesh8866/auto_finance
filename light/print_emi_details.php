<?php
include "connect.php";

$acc=$_GET['acc'];

if($_GET['type']=="E")
{
header("Content-type: application/vnd.ms-xls");
$name='Customer_EMI_Report'.'_'.time().'.xls';
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
    <title>Customer EMI Report</title>

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
    <h4>Monthly EMI Report</h4>
        <?php 
            $result2=mysqli_fetch_array(mysqli_query($link,"select `acc_no`,`name`,`address`,`mob_no` from customer WHERE acc_no='$acc'"));   
        ?>
    <table width="100%">
    <tr>
        <td width="50%"><b>Account Number: </b> <?php echo $result2['acc_no']; ?></td>
        <td width="50%"><b>Contact number: </b><?php echo $result2['mob_no']; ?></td>
    </tr>
    <tr>
        <td width="50%"><b>Customer Name: </b><?php echo $result2['name']; ?></td>
        <td width="50%"><b>Address: </b><?php echo $result2['address']; ?></td>
    </tr>
    </table>
    
    <table Width="100%" border="1" rules="all">
                      <thead>
                        <tr>
                          <th> No </th>
                          <th>EMI Date</th>
                          <th>EMI</th>
                          <th>Pay Date</th>
                          <th>Pay Amount</th>
                          <th>Inst Clear</th>
                        </tr>
                      </thead>
        <tbody>
                <?php                                         
                                                        
						$row=mysqli_fetch_array(mysqli_query($link,"select * from customer WHERE acc_no='$acc'"));    
						$i=0;
						$total_pay=0;
						$total=0;
						for($j=$i;$j<$row['loan_month'];$j++){
														
						 $date1=date('d-m-Y',strtotime('+'.$j.' Month '.$row['first_emi_date']));
                         $date2=date('Y-m-d',strtotime($date1));	
						 list($pid,$pay_amount,$paydate,$instnum,$capital,$inst)=mysqli_fetch_array(mysqli_query($link,"select p_id,sum(amount),pay_date,inst_no,emi_capital,emi_interest from payment where acc_no='$acc' and inst_no='".($j+1)."'"));
						 
						 list($clear,$emi)=mysqli_fetch_array(mysqli_query($link,"select `inst_clear`,emi from `cust_inst_record` WHERE `acc_no`='$acc' and `inst_no`='".($j+1)."' and `inst_date`='$date2'"));	
						 				
				?>
                        <tr style="text-align:center;">
                          <td><?php echo $j+1;?></td>
                          <td><?php echo $date1; ?></td>
                          <td><?php echo $row['emi']; ?></td>
                          <td><?php if($paydate!=''){ echo date('d-m-Y',strtotime($paydate));} ?></td>
                          <td><?php echo $pay_amount;?></td>
                          <td>
                             <?php echo $clear; ?>
                          </td>
                        </tr>
                        <?php  $total= $total + $row['emi']; 
                        $total_pay= $total_pay + $pay_amount;}  ?>
                          <tr style="text-align:center;">
                            <td></td>
                            <td></td>
                            <td><b>Total: </b><br><b><?php echo round($total); ?></b></td>
                              <td></td>
                            <td><b>Remaining: </b><br><b><?php echo round($total - $total_pay); ?></b></td>
                            <td></td>

                          </tr>
                      </tbody>
    </table>
    
<script>
    window.print();
</script> 
</html>    