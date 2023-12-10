<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";

$id=$_GET['id'];
$sql="select * from showroom_payment where sh_payid='$id'";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_array($result);
?>
<script>

function showbankdetails(val){
    if(val=='cheque'){
        document.getElementById('bank').style.display='block';
        document.getElementById('c_date').setAttribute("required","");
        document.getElementById('c_number').setAttribute("required","");

    }
    else{
        document.getElementById('bank').style.display='none';
        document.getElementById('c_date').value="";
        document.getElementById('c_number').value="";

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
                                
                                <h5>Edit Pay Showroom</h5><hr>
                                
                                <?php
                                //echo $row['cheque_date']; ?>

                                <form class="form-sample" action="showroom_payment_update_exe.php?id=<?php echo $id; ?>" method="POST">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="basic-url">Date</label>
                                        <div class="mb-3">
                                            <input type="date" name="shpaydate" id="shpaydate" class="form-control" value="<?php echo date('Y-m-d',strtotime($row['pay_date'])); ?>" required disabled>
                                        </div>  
                                    </div>
                                    <div class="col-md-4">
                                        <label for="basic-url">Showroom</label>
                                        <div class="mb-3">
                                            <select name="showroom" id="select3" class="form-control" required disabled>
                                            <?php 
                                              $sql1="SELECT sp.sh_id,s.sh_name FROM showroom_payment sp JOIN showroom s ON sp.sh_id=s.sh_id WHERE sh_payid='$id'";
                                              $result1=mysqli_query($link,$sql1);
                                               while($row1=mysqli_fetch_array($result1)) {
                                            ?>
                                            <option value="<?php echo $row1['sh_id']; ?>" <?php if($row['sh_id']==$row1['sh_id']) echo 'selected'; ?>><?php echo $row1['sh_name'];?></option>
                                            <?php } ?>
                                            </select>
                                  
                                        </div>  
                                    </div>  
                                    <div class="col-md-4">
                                        <label for="basic-url">Customer</label>
                                        <div class="mb-3">
                                            <select name="customer" id="customer" class="form-control" required disabled>
                                            <?php 
                                              $sql2="SELECT sp.acc_no,c.name FROM showroom_payment sp JOIN customer c ON sp.acc_no=c.acc_no WHERE sh_payid='$id'";
                                              $result2=mysqli_query($link,$sql2);
                                               while($row2=mysqli_fetch_array($result2)) {
                                            ?>
                                              <option value="<?php echo $row2['acc_no']; ?>" <?php if($row['acc_no']==$row2['acc_no']) echo 'selected'; ?>><?php echo '['.$row2['acc_no'].'] '; ?><?php echo $row2['name'];?></option> 
                                            <?php } ?>  
                                            </select>
                                        </div>  
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <?php 
                                    $sql3="SELECT `acc_no`,`vehicle_amount`,`downpayment` FROM `customer` WHERE `acc_no`='".$row['acc_no']."'";
                                    $result3=mysqli_query($link,$sql3);
                                    $row3=mysqli_fetch_array($result3);
                                    ?>
                                     <div class="col-md-4">
                                         
                                         <label><b>Account no:-</b></label><span><?php echo $row['acc_no']; ?></span>  <br>
                                         <label><b>Vehicle Amount:-</b></label><span><?php echo $row3['vehicle_amount']; ?></span><br>  
                                         <label><b>Down Payment:-</b></label><span><?php echo $row3['downpayment']; ?></span><br>  

                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="basic-url">Vehicle Amount</label>
                                        <div class="mb-3">
                                            <input type="text" name="v_amount" id="v_amount" placeholder="Vehicle Amount" value="<?php echo $row3['vehicle_amount']; ?>" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                    <label for="basic-url">Remarks</label>
                                        <div class="mb-3">
                                            <input type="text" name="remarks" id="remarks" placeholder="Enter remarks" class="form-control" value="<?php echo $row['other']; ?>" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                    <div class="form-group">
                                        <label><b>Payment Type</b></label><br>
                                        <div class="custom-control custom-radio inline-cr">
                                            <input type="radio" name="type1" class="custom-control-input" id="cash" value="cash" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="type" onchange="showbankdetails(this.value);" <?php if($row['type']=="cash") echo 'checked'; ?>>
                                            <label class="custom-control-label" for="cash">Cash</label>
                                        </div>
                                        <div class="custom-control custom-radio inline-cr">
                                            <input type="radio" name="type1" class="custom-control-input" id="cheque" value="cheque" data-parsley-multiple="type" onchange="showbankdetails(this.value);" <?php if($row['type']=="cheque") echo 'checked'; ?>>
                                            <label class="custom-control-label" for="cheque" >Cheque</label>
                                        </div>
                                        <p id="error-radio"></p>
                                    </div>

                                    </div>
                                    </div>    
                                    
                                <div id="bank"  <?php if($row[type]=='cheque') echo 'style="display:block;"'; else echo 'style="display:none;"';   ?>>    
                                <div class="row" >
                                    <div class="col-md-4">
                                    <label for="basic-url">Cheque Number</label>
                                    <div class="mb-3">
                                        <input type="text" name="c_number" id="c_number" placeholder="Enter Cheque number" class="form-control" autocomplete="off" value="<?php echo $row['cheque_no']; ?>">
                                    </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="basic-url">Cheque date</label>
                                        <div class="mb-3">
                                            <input type="date" name="c_date" id="c_date" class="form-control" autocomplete="off" value="<?php echo date('Y-m-d',strtotime($row['cheque_date'])); ?>">
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
    
   <?php
include "footer.php";
