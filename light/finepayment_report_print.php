<?php
include "connect.php";

if($_GET['type']=="E")
{
header("Content-type: application/vnd.ms-xls");
$name='Payment_Report'.'_'.time().'.xls';
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
    <title>Fine Payment report</title>

    <link rel="stylesheet" href="../assets/vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendor/fontawesome/css/font-awesome.min.css">
<!--    <link rel="stylesheet" href="../assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">-->
    <link rel="stylesheet" href="../assets/css/main.css" type="text/css">
    
      <!-- DataTables -->
      <link rel="stylesheet" href="datatable/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="datatable/responsive.bootstrap4.min.css">
</head>

 <h4><b>Fine Payment Report:</b></h4>


 <table border="1" width="100%" rules="all">
                      <thead>
                        <tr style="text-align:center;">
                         
                         <th>Sr No</th>
                          <th>Acc No </th>                          
                          <th>Name</th>
                          <th>Amount</th>
                          <th>Payment Type</th>
                          <th>Date</th>                                                  
                        
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php                                         
                         //echo "select payment.acc_no,payment.inst_no,customer.name,payment.amount,payment.type,payment.pay_date,payment.emi_date FROM payment JOIN customer ON payment.acc_no=customer.acc_no where payment.pay_date BETWEEN '".$_GET['from']."' AND '".$_GET['to']."'";     
                          
                          if($from!='' && $to!=''){
						 $row="select fine_payment.f_id,fine_payment.acc_no,customer.name,fine_payment.amount,fine_payment.type,fine_payment.fine_pay_date FROM fine_payment JOIN customer ON fine_payment.acc_no=customer.acc_no where fine_payment.fine_pay_date BETWEEN '".$_REQUEST['from']."' AND '".$_REQUEST['to']."'";    
                          
                        $result=mysqli_query($link,$row);
                                                        $i=0;
                                                        while( $show1=mysqli_fetch_array($result)) {                                                  
                                                        $i++
                                                        ?>
                                                           
                                                            <tr>
                                                                <td>
                                                               <?php echo $i; ?>                                                      
                                                                </td>
                                                                <td>
                                                                  <?php echo $show1['acc_no']; ?>
                                                                </td>                                                               
                                                                <td>
                                                                  <?php echo $show1['name']; ?>
                                                                </td>
                                                                <td>
                                                                  <?php echo $show1['amount']; ?>
                                                                </td>
                                                                <td>
                                                                  <?php echo $show1['type']; ?>
                                                                </td>
                                                                <td>
                                                                  <?php echo $show1['fine_pay_date']; ?>
                                                                </td>                                                               
                                                                
                                                                                                   
                                                               
                                                            </tr>
                                                    <?php } }?>    
                      </tbody>
                    </table>
                    
                   <script>
    window.print();
</script>
</html>