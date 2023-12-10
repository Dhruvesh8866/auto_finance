<?php
include "connect.php";

if($_GET['type']=="E")
{
header("Content-type: application/vnd.ms-xls");
$name='Receipt_Report'.'_'.time().'.xls';
header("Content-Disposition: attachment;Filename=$name");
}
$from=$_REQUEST['from'];
$to=$_REQUEST['to'];
?>


<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="ThemeMakker">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Customer Payment report</title>

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

 <h4><b>Payment Report:</b></h4>


 <table border="1" width="100%" rules="all">
                      <thead>
                        <tr style="text-align:center;">
                         <th>Sr No</th>
                         <th>Acc No </th>  
                         <th>Name</th>
                         <th>Pay Date</th>
                         <th>EMI No.</th>
                         <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php                                         
                         //echo "select payment.acc_no,payment.inst_no,customer.name,payment.amount,payment.type,payment.pay_date,payment.emi_date FROM payment JOIN customer ON payment.acc_no=customer.acc_no where payment.pay_date BETWEEN '".$_GET['from']."' AND '".$_GET['to']."'";     
                          
                          if($from!='' && $to!=''){
						 $row="select payment.acc_no,customer.name,payment.amount,payment.pay_date,payment.inst_no FROM payment JOIN customer ON payment.acc_no=customer.acc_no where payment.pay_date BETWEEN '".$_REQUEST['from']."' AND '".$_REQUEST['to']."' and payment.acc_no='".$_REQUEST['acc_no']."'";    
                          
                        $result=mysqli_query($link,$row);
                                                        $i=0;
                                                        while( $show1=mysqli_fetch_array($result)) {                                                  
                                                        $i++
                                                        ?>
                                                           
                                                            <tr>
                                                                <td style="text-align:center;"><?php echo $i; ?></td>
                                                                <td style="text-align:center;"><?php echo $show1['acc_no']; ?></td>
                                                                <td><?php echo $show1['name']; ?></td>
                                                                <td style="text-align:center;"><?php echo date('d-m-Y',strtotime($show1['pay_date'])); ?></td>
                                                                <td><?php echo $show1['inst_no']; ?></td>
                                                                <td style="text-align:center;"><?php echo $show1['amount']; ?></td>  
                                                            </tr>
                                                    <?php } }?>    
                      </tbody>
                    </table>
                    
                   <script>
    window.print();
</script>
</html>