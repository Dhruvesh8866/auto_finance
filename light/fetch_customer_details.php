<?php
include "connect.php";
$acc=$_GET['cid'];

$check="SELECT `acc_no` FROM showroom_payment WHERE `acc_no`='$acc'";
    mysqli_query($link,$check);
    if(mysqli_affected_rows($link)>0){
        $_SESSION['fail']='<h3>Payment is already done</h3>...'; 
     } 

$check="SELECT `acc_no` FROM showroom_payment WHERE `acc_no`='$acc'";
    mysqli_query($link,$check);
    if(mysqli_affected_rows($link)>0){
        $_SESSION['fail']='Payment is already done...';    
    }
$sql2="SELECT `acc_no`,`vehicle_amount`,`downpayment` FROM `customer` WHERE `acc_no`='".$_GET['cid']."'";
$result2=mysqli_query($link,$sql2);
$row1=mysqli_fetch_array($result2);

?>


    
     
 



                            <?php if(isset($_SESSION['fail']) && $_SESSION['fail']==true){ ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['fail'];?>    
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                            <?php } unset($_SESSION['fail']); ?>


                    <div class="row">
                                     <div class="col-md-4">
                                         <label><b>Account no:-</b></label><span><?php echo $row1['acc_no']; ?></span>  <br>
                                         <label><b>Vehicle Amount:-</b></label><span><?php echo $row1['vehicle_amount']; ?></span><br>  
                                         <label><b>Down Payment:-</b></label><span><?php echo $row1['downpayment']; ?></span><br>  

                                    </div>
                                    <div class="col-md-4">
                                     
                                  <label for="basic-url">Vehicle Amount</label>
                                <div class="mb-3">
                              <input type="text" name="v_amount" id="v_amount" placeholder="Vehicle Amount" value="<?php echo $row1['vehicle_amount']; ?>" class="form-control" autocomplete="off" required>
                                </div>
                                    
                                    </div>
                                <div class="col-md-4">
                                    
                                    <label for="basic-url">Remarks</label>
                                <div class="mb-3">
                              <input type="text" name="remarks" id="remarks" placeholder="Enter remarks" class="form-control" autocomplete="off">
                                </div>
                                    </div>
                                </div>  
                                    
                                    
                                <div class="row">
                                    
                                    <div class="col-md-4 mt-2">
                                    <div class="form-group">
                                        <label><b>Payment Type</b></label>
                                        <br>
                                        <div class="custom-control custom-radio inline-cr">
                                            <input type="radio" name="type1" class="custom-control-input" id="cash" value="cash" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="type" onchange="showbankdetails(this.value);" checked>
                                            <label class="custom-control-label" for="cash">Cash</label>
                                        </div>
                                        <div class="custom-control custom-radio inline-cr">
                                            <input type="radio" name="type1" class="custom-control-input" id="cheque" value="cheque" data-parsley-multiple="type" onchange="showbankdetails(this.value);">
                                            <label class="custom-control-label" for="cheque" >Cheque</label>
                                        </div>
                                        <p id="error-radio"></p>
                                    </div>

                                    </div>
                                    </div> 
