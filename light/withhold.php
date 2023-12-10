<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";
$search=trim($_REQUEST['vehicle']);

if($search!=""){
                                    
    $sql="select `acc_no` from customer WHERE acc_no='$search'";
    mysqli_query($link,$sql);
    if(mysqli_affected_rows($link)>0){
        mysqli_query($link,"select `acc_no` from customer WHERE wh_back='Yes' and acc_no=$search");
        if(mysqli_affected_rows($link)>0){
                    $_SESSION['fail']='Account is already added...';

            }
        else{    
            
        $show="UPDATE `customer` SET `wh_back`='Yes' WHERE acc_no='$search' ";                                           
        mysqli_query($link,$show);
        $_SESSION['success']='Vehicle record added successfully...';}

    }
    else{     
        $_SESSION['fail']='Error! Account number is not found in system';                                         
    }
}

?>

<script>
function print_withhold(type){
    //alert(type);
    window.open("withhold_print.php?type="+type, '_blank');
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
                            <?php if(isset($_SESSION['back']) && $_SESSION['back']==true){ ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['back'];?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                            <?php } unset($_SESSION['back']); ?>
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
                                <h4>With hold vehicle</h4><hr>
                                
                                <button type="button" class="btn btn-warning btn-sm" onclick="print_withhold('P');"><i class="fa fa-print"></i> Print</button>

                                <button type="button" class="btn btn-slack btn-sm" onclick="print_withhold('E');"><i class="fa fa-file-excel-o"></i> Excel</button>
                        
                                <div class="input-group mb-3"> </div> 
                                
                                <form id="form2" name="form2" method="post" action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group" id="adv-search">
                                        <label class="col-form-label">Account no</label>
                                        <input type="text" class="form-control ml-3" name="vehicle" id="vehicle" autocomplete="off" >
                                        <div class="input-group-btn ml-3">
                                        <div class="btn-group" role="group">
                                            <button type="submit" class="btn btn-primary"><span class=" fa fa-undo" aria-hidden="true" onclick="check_acc();"></span> Return</button>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                        
                                    
                                </div>  
                                </form>   
                                
                                <div class="input-group mb-4"> </div>
                                <table class="table table-bordered table-striped table-hover" id="example1">
                                <thead>
                                <tr>
                                    <th> Acc no. </th>
                                    <th> Name </th>
                                    <th> Date </th>
                                    <th> Contact </th>
                                    <th> Loan amount </th>
                                    <th> Action</th>    
                                </tr>
                                </thead>
                                    <tbody>
                                  <?php 
                                    
                                    $sql1="select * from customer WHERE `wh_back`='Yes' ";    
                                    $result=mysqli_query($link,$sql1);
                                      while($row=mysqli_fetch_array($result)){
                                      ?>	  
                                      <tr>
                                        <td><?php echo $row['acc_no']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['loan_date']; ?></td>
                                        <td><?php echo $row['mob_no']; ?></td>
                                        <td><?php echo $row['loan_amount']; ?></td>
                                        <td><a href="whback.php?id=<?php echo $row['acc_no']; ?>"><button type="button" class="btn btn-danger btn-icon-only rounded-circle" onClick="return confirm('Are you sure you want to delete this record?')"><span class="btn-inner--icon"><i class="fa fa-trash-o"></i></span></button></a>      
                                        
                                        </td>
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