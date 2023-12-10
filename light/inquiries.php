<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";


?>

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
                                <h4>Inquiries</h4><hr>
                                
                                <div class="input-group mb-3"> </div>
                                <table class="table table-bordered table-striped table-hover" id="example1">
                                <thead>
                                <tr>
                                    <th> No. </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Subject </th>
                                    <th> Comment </th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    $sql="select * from inquiry order by sr_no desc";
                                    $i=0;
                                    $result=mysqli_query($link,$sql);
                                      while($row=mysqli_fetch_array($result)){
                                        $i++;  
                                      ?>	  
                                      <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['subject']; ?></td>
                                        <td><?php echo $row['comment']; ?></td>
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