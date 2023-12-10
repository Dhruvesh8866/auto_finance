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
function check_acc(){    
    var acc=document.getElementById('vehicle').value;
    if(acc.trim()==""){
        //document.getElementById('vehicle').value.trim();
        alert("Enter Account number");
    }
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
                                <h4>Installment Remaining Report</h4><hr>
                                

                                <form id="form2" name="form2" method="post" action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group" id="adv-search">
                                        <input type="text" class="form-control ml-3" name="vehicle" id="vehicle" placeholder="Enter installment number" autocomplete="off" value="<?php echo $search; ?>">
                                        <div class="input-group-btn ml-3">
                                        <div class="btn-group" role="group">
                                            <button type="submit" class="btn btn-primary"><span class=" fa fa-search" aria-hidden="true"></span> Search</button>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>  
                                </form>   
                                
                                <div class="input-group mb-4"> </div>
                                
                                
                                
                                

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