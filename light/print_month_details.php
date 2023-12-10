<?php
include "connect.php";
$search=$_REQUEST['cur_date'];
if($_GET['type']=="E")
{
header("Content-type: application/vnd.ms-xls");
$name='Monthly_EMI_Report'.'_'.time().'.xls';
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
    <title>Monthly EMI report</title>

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
        <h4><b>Monthly EMI Report:</b></h4>
    <table border="1" width="100%" rules="all">
                      <thead>
                        <tr>
                          <th>Acc No </th>
                          <th>Name</th>
                          <th>Contact</th>
                          <th>Inst No.</th>
                          <th>EMI Date</th>
                          <th>Status</th>
                          <th>EMI amount</th>    
                        </tr>
                      </thead>
                      <tbody>
                        <?php                                         
                           $inst_res="SELECT cir.acc_no, cir.inst_no, cir.inst_date, cir.inst_clear, cir.emi, c.name, c.mob_no FROM cust_inst_record cir JOIN customer c ON cir.acc_no=c.acc_no WHERE DATE_FORMAT(cir.inst_date,'%m-%Y')='$search'";
//                          $inst_res="SELECT cir.acc_no, cir.inst_no, cir.inst_date, cir.inst_clear, cir.emi, c.name, c.mob_no FROM cust_inst_record cir JOIN customer c ON cir_acc_no=c.acc_no WHERE DATE_FORMAT(cir.inst_date,'%m-%Y')='$search'";
                            $inst_result=mysqli_query($link,$inst_res);
                          while($row=mysqli_fetch_array($inst_result)){  ?>
                              <tr>
                                        <td style="text-align:center";><?php echo $row['acc_no']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['mob_no']; ?></td>
                                        <td><?php echo $row['inst_no']; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($row['inst_date'])); ?></td>
                                        <td style="text-align:center";><?php echo $row['inst_clear']; ?></td>
                                        <td><?php echo $row['emi']; ?></td>
                                </tr>
                         <?php } ?>
                      </tbody>
                </table>
    
<script>
    window.print();
</script>
</html>    