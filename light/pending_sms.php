<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";


?>
<script>

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
                            <?php if(isset($_SESSION['success']) && $_SESSION['success']==true){ ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['success'];?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                            <?php } unset($_SESSION['success']); ?>
                            
                            <?php if(isset($_SESSION['fail']) && $_SESSION['fail']==true){ ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['fail'];?>    
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                            <?php } unset($_SESSION['fail']); ?>
                            
                            <div class="body">
                                <h4>Pending Messages</h4><hr>
                                
                                

<!--
                                <button type="button" class="btn btn-warning btn-sm" onclick="print_customers('P');"><i class="fa fa-print"></i> Print</button>

                                <button type="button" class="btn btn-slack btn-sm" onclick="print_customers('E');"><i class="fa fa-file-excel-o"></i> Excel</button>
-->
                                
                                  
                              
                                
                                
                                

                                <div class="input-group mb-3"> </div>
                                <table class="table table-bordered table-striped table-hover" id="example1">
                                <thead>
                                <tr>
                                    <th> Sr no. </th>
                                    <th> Message </th>
                                    <th> Contact </th>
                                    <th> Created </th>
                                      
                                </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    
                                       $sql="SELECT * FROM `sms` WHERE `status`='N'";
                                    
                                    //$sql= "SELECT `acc_no`,`name`,`mob_no`,`loan_amount`,`total_loan`,`city`,`district` FROM `customer`";
                                    $result=mysqli_query($link,$sql);
                                      while($row=mysqli_fetch_array($result)){
                                      ?>	  
                                      <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['sms']; ?></td>
                                        <td><?php echo $row['mob_no']; ?></td>
                                        <td><?php echo $row['created']; ?></td>
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