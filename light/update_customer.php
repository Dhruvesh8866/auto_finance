<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";

$id=$_GET['id'];

$sql="select * from customer where acc_no='$id'";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_array($result);
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
                            
                            
                            <div class="body">
                                <h4>Update Customer</h4><hr>
                            <form class="form-sample" action="update_customer_exe.php?id=<?php echo $id; ?>" method="post">
                      <!--<p class="card-description"> Add showroom details </p> -->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Account no</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3"> 
                              <input type="number" name="acc_no" id="acc_no" class="form-control" placeholder="Enter Account number" value="<?php echo $row['acc_no'];?>" required disabled>
                                
                                </div>
                                <small id="showdata"></small>
                            </div>
                          </div>
                        </div>
                      </div>
                        
                        <!-- changes start -->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                              <input type="text" name="ctr_name" id="textfield2" placeholder="Enter Custommer name" value="<?php echo $row['name'];?>" class="form-control" required disabled>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <textarea name="ctr_address" id="textarea" rows="3" class="form-control" required><?php echo $row['address'];?></textarea>
                            </div>
                            </div>
                            
                       </div>
                      </div>
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phone no</label>
                            <div class="col-sm-9">
                              <input type="number" name="ctr_contact" id="textfield3" class="form-control" value="<?php echo $row['mob_no'];?>" placeholder="eg. 9876543210">
                            </div>
                              
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Birth Date</label>
                            <div class="col-sm-9">
                              <input type="date" name="birthday" id="textfield26" value="<?php echo $row['birthday'];?>" class="form-control">
                            </div>
                            </div>
                       </div>
                      </div>
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-3">
                             <select name="city" id="select1" class="form-control" required>
                                <option value="">City</option> 
                                <option value="Palanpur" <?php if($row['city']=="Palanpur") echo 'selected';?>>Palanpur</option>
                                <option value="Mehsana" <?php if($row['city']=="Mehsana") echo 'selected';?>>Mehsana</option>
                                <option value="Ahmedabad" <?php if($row['city']=="Ahmedabad") echo 'selected';?>>Ahmedabad</option>
                              </select>
                            </div>
                            <label class="col-sm-2 col-form-label">District</label>
                            <div class="col-sm-4">
                                <select name="district" id="select2" class="form-control" required>
                                    <option value="">District</option>
                                    <option value="Banaskantha" <?php if($row['district']=="Banaskantha") echo 'selected';?>>Banaskantha</option>
                                    <option value="Mehsana" <?php if($row['district']=="Mehsana") echo 'selected';?>>Mehsana</option>
                                    <option value="Ahmedabad" <?php if($row['district']=="Ahmedabad") echo 'selected';?>>Ahmedabad</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Pincode</label>
                            <div class="col-sm-6">
                              <input type="number" name="pincode" id="textfield27" placeholder="eg. 385456" value="<?php echo $row['pincode'];?>" class="form-control"  required>
                            </div>
                            </div>
                       </div>
                      </div>
                     
                    <!-- Loan Detail cell--> 
                        <h4>Loan Details</h4>  <hr>      
                      <div class="row">
                        <div class="input-group mb-3"> </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vehicle Amount</label>
                            <div class="col-sm-3">
                                <input type="number" name="vehicle_amount" id="textfield28" placeholder="eg. 50000" class="form-control" value="<?php echo $row['vehicle_amount'];?>" required disabled>
                            </div>
                              
                            <label class="col-sm-3 col-form-label">Down Payment</label>
                            <div class="col-sm-3">
                                <input type="number" name="downpayment" id="textfield29" class="form-control" placeholder="eg. 2000" value="<?php echo $row['downpayment'];?>"  disabled>
                            </div>
                              
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Loan File Charge</label>
                            <div class="col-sm-3">
                                <input type="number" name="file_charge" id="textfield8" class="form-control" placeholder="eg. 100" value="<?php echo $row['file_charge'];?>" required disabled>
                            </div>
                              
                            <label class="col-sm-3 col-form-label">Loan Amount</label>
                            <div class="col-sm-3">
                                <input type="number" name="loan_amount" id="textfield4" class="form-control" placeholder="eg. 50000" value="<?php echo $row['loan_amount'];?>" required disabled>
                            </div>  
                          </div>
                        </div>
                      </div>
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Loan Month</label>
                            <div class="col-sm-3">
                                <input type="number" name="loan_month" id="textfield5" class="form-control" placeholder="eg. 12" value="<?php echo $row['loan_month'];?>" required disabled>
                            </div>
                              
                            <label class="col-sm-3 col-form-label">Loan interest[%]</label>
                            <div class="col-sm-3">
                                <input type="number" name="loan_rate" id="textfield6" class="form-control" placeholder="Interest value" value="<?php echo $row['loan_rate'];?>" required disabled>
                            </div> 
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Total Loan</label>
                            <div class="col-sm-9">
                              <input type="number" name="total_loan" id="textfield10" placeholder="Total loan" class="form-control" value="<?php echo $row['total_loan'];?>" required disabled>
                            </div>
                            </div>
                       </div>
                      </div>
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Loan EMI</label>
                            <div class="col-sm-3">
                                <input type="number" name="emi" id="textfield7" class="form-control" placeholder="monthly EMI" value="<?php echo $row['emi'];?>" required disabled>
                            </div>
                              
                            <label class="col-sm-3 col-form-label">Late Fine Charge</label>
                            <div class="col-sm-3">
                                <input type="number" name="fine" id="textfield9" class="form-control" placeholder="Enter Fine" value="<?php echo $row['fine'];?>" required disabled>
                            </div> 
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Showroom</label>
                            <div class="col-sm-9">
   
                              <select name="showroom" id="select3" class="form-control" required disabled>
                                  <?php 
                                  $sql1="SELECT showroom.sh_id,showroom.sh_name FROM customer JOIN showroom ON showroom.sh_id=customer.showroom";
                                  $result1=mysqli_query($link,$sql1);
                                   while($row1=mysqli_fetch_array($result1)) {
                                  ?>
                                  <option value="<?php echo $row1['sh_name']; ?>" <?php if($row['showroom']==$row1['sh_id']) echo 'selected'; ?>><?php echo $row1['sh_name'];?></option>
                                  <?php } ?>

                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Loan Date </label>
                            <div class="col-sm-9">
                              <input type="date" name="loan_date" id="textfield11" class="form-control" value="<?php echo $row['loan_date'];?>" required disabled>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">First EMI date</label>
                            <div class="col-sm-9">
                              <input type="date" name="first_emi_date" id="textfield12" class="form-control" value="<?php echo $row['first_emi_date'];?>" required disabled>
                            </div>
                            </div>
                       </div>
                      </div>
                    
                    <!-- Vehicle Details cell-->
                    <h4>Vehicle Details</h4><hr>            
                      <div class="row">
                        <div class="input-group mb-3"> </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Registration no</label>
                            <div class="col-sm-9">
                                <input type="text" name="v_reg_no" id="textfield13" placeholder="Enter vehicle registration number" class="form-control" value="<?php echo $row['vehicle_reg_no'];?>" required>
                            </div>
                              
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Chassis number</label>
                            <div class="col-sm-9">
                                <input type="text" name="ch_no" id="textfield14" class="form-control" placeholder="Enter chassis number" value="<?php echo $row['chassis_no'];?>"  required>
                            </div>  
                          </div>
                        </div>
                      </div>
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Engine no</label>
                            <div class="col-sm-3">
                                <input type="text" name="eng_no" id="textfield15" class="form-control" placeholder="Enter Engine number" value="<?php echo $row['engine_no'];?>" required>
                            </div>
                              
                            <label class="col-sm-2 col-form-label">Model</label>
                            <div class="col-sm-4">
                                <input type="text" name="model" id="textfield16" class="form-control" placeholder="Model name" value="<?php echo $row['model'];?>" required>
                            </div> 
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Other</label>
                            <div class="col-sm-9">
                                <input type="text" name="other" id="textfield7" class="form-control" value="<?php echo $row['other'];?>">
                            </div> 
                          </div>
                        </div>  
                      </div>
                                
                    <h4>Gurantor Details</h4><hr>
                    <!-- Gurantor detail cell-->
                      <div class="row">
                        <div class="input-group mb-3"> </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gurantor Name</label>
                            <div class="col-sm-9">
                              <input type="text" name="gtr_name" id="textfield18" class="form-control" placeholder="Enter Gurantor name" value="<?php echo $row['gtr_name'];?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Gurantor Contact</label>
                            <div class="col-sm-9">
                              <input type="number" name="gtr_contact" id="textfield18" placeholder="Enter Gurantor contact" class="form-control" value="<?php echo $row['gtr_contact'];?>" required>
                            </div>
                            </div>
                        </div>
                      </div>
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gurantor Address</label>
                            <div class="col-sm-9">
                                <textarea name="gtr_address" id="textfield19" cols="30" rows="5" class="form-control"><?php echo $row['gtr_address'];?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">File upload</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                        <input type="file" name="gtr_document" id="fileField" class="custom-file-input" value="<?php echo $row['gtr_document'];?>"/>
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    <a href="upload/<?php echo $row['gtr_document']; ?>" class="btn btn-sm btn-success" target="_blank">View Document</a>
                                </div>
                            </div>
                        </div>
                       </div>
                      </div>
                        
                    <!-- changes end -->
                        
                    <div class="btn-container">
                        <button type="submit" class="btn btn-primary ">
                                <span class="btn-inner--icon"><i class="fa fa-refresh"></i></span> Update
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='customers.php'">
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