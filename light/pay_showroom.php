<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";


?>
<script>
                                    
function viewcustomer(s_id){
        //alert(s_id);
        //alert();
        $('#getcos').load('new_fetch_customer.php?sid='+s_id);
        }
function customerdetails(c_id){
    
    //alert(c_id);
    
    $('#newgshow').load('fetch_customer_details.php?cid='+c_id);
    
}
function showbankdetails(val){
    if(val=='cheque'){
        document.getElementById('bank').style.display='block';
         document.getElementById('c_date').required=true;
        document.getElementById('c_number').required=true;

    }
    else{
        document.getElementById('bank').style.display='none';
        document.getElementById('c_number').required=false;
        document.getElementById('c_date').disabled=true;
    }
    //alert(val);
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
                                
                                
                                
                                <h5>Pay Showroom</h5><hr>
                                
                                
                                
                                <form class="form-sample" action="pay_showroom_insert.php" method="POST" >
                                <div class="row">
                                     <div class="col-md-4">
                                <label for="basic-url">Date</label>
                                <div class="mb-3">
                                    <input type="date" name="shpaydate" id="shpaydate" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
                                </div>  
                                    </div>
                                    <div class="col-md-4">
                                <label for="basic-url">Showroom</label>
                                <div class="mb-3">
                                    <select name="showroom" id="showroom" class="form-control" onchange="viewcustomer(this.value);" required>
                                        <option value="">Select Showroom</option>
                                        <?php 
                                          $sql1="SELECT `sh_id`,`sh_name` FROM `showroom`;";
                                          $result1=mysqli_query($link,$sql1);
                                           while($row=mysqli_fetch_array($result1)) {
                                        ?>
                                          <option value="<?php echo $row['sh_id']; ?>"><?php echo $row['sh_name']; ?></option> 
                                        <?php } ?>  
                                    </select>
                                  
                                </div>  
                                    </div>
                                    <div class="col-md-4">
                                <label for="basic-url">Customer</label>
                                <div class="mb-3" id="getcos">
                                    <select name="customer" id="customer" class="form-control" required disabled>
                                        <option value="">Select Customer</option>
                                        <?php 
                                          //$sql1="SELECT `name` FROM `customer` WHERE `showroom`=;";
                                          $result1=mysqli_query($link,$sql1);
                                           while($row=mysqli_fetch_array($result1)) {
                                        ?>
                                          <option value="<?php echo $row['acc_no']; ?>"><?php echo $row['name']; ?></option> 
                                        <?php } ?>  
                                    </select>
                                </div>  
                                    </div>
                                </div>

<!--                                division shows customers details-->
                                <div id="newgshow">    
                                
                                </div>
<!--                                division shows bank details-->
                                <div id="bank" style="display:none;">    
                                <div class="row" >
                                    <div class="col-md-4">
                                    <label for="basic-url">Cheque Number</label>
                                    <div class="mb-3">
                                        <input type="text" name="c_number" id="c_number" placeholder="Enter Cheque number" class="form-control" autocomplete="off">
                                    </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="basic-url">Cheque date</label>
                                        <div class="mb-3">
                                            <input type="date" name="c_date" id="c_date" class="form-control" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
                                        </div>

                                    </div>
                                </div> 
                                </div>
                                    
                                <div class="btn-container">
                                    <button type="submit" class="btn btn-primary">
                                            <span class="btn-inner--icon"><i class="fa fa-file-text"></i></span> Save
                                    </button>
                                    <button type="button" class="btn btn-secondary" onclick="window.location.href='showroom_payment.php'">
                                            <span class="btn-inner--icon"><i class="fa fa-arrow-left"></i></span> Back
                                    </button>
                                            
                                </div>
                            </form>      
                                
                                

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