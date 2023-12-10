<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";


?>
<script>
function loan_complete(type){
    //alert(type);
    window.open("loan_complete_print.php?type="+type, '_blank');
}
</script>
        

    <div class="main_content" id="main-content">
        <div class="page">

            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task">
<!--
                            <div class="header">
                                <h2>Add Showroom</h2>
                            </div>
-->
                            <div class="body">
                                <h4>Loan Complete </h4> 
                                <hr>
                                <button type="button" class="btn btn-warning btn-sm" onclick="loan_complete('P');"><i class="fa fa-print"></i> Print</button>
                                <button type="button" class="btn btn-slack btn-sm" onclick="loan_complete('E');"><i class="fa fa-file-excel-o"></i> Excel</button>
                                <div class="input-group mb-3"> </div>
                                <table class="table table-bordered table-striped table-hover" id="example1">
                                <thead>
                                <tr>
                                    <th> Acc no. </th>
                                    <th> Name </th>
                                    <th> Address</th>
                                    <th> Contact </th>
                                    <th> Loan Amount </th>
                                    <th> Loan Rate </th>
                                    <th> Total Loan </th>
                                    <th> Monthly EMI </th>
                                        
                                </tr>
                                </thead>
                                    <tbody>
                                  <?php 
                                    
                                    $sql1="select * from customer WHERE `loan_clear`='Yes' ";    
                                    $result=mysqli_query($link,$sql1);
                                      while($row=mysqli_fetch_array($result)){
                                      ?>	  
                                      <tr>
                                        <td><?php echo $row['acc_no']; ?></td>
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
                            

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    
   <?php
include "footer.php";


?>