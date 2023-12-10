<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";

list($max_accno)=mysqli_fetch_array(mysqli_query($link,"SELECT max(acc_no)+1 FROM `customer`"));

?>
<script>
function change_status(val){    
	$.ajax({
		url:"check_account.php",
		type:"post",
		data:{val:val},
		success:function(result) {
			//alert(result);
            if(result=='1'){
                document.getElementById("acc_no").value="";
                document.getElementById("showdata").innerHTML="Account number is already exist";
                document.getElementById("showdata").style="color:red;";
               //$('#showdata').html(result);
            }else{
                
                document.getElementById("showdata").innerHTML="";
            }           
            
		}
	});
}
    function check_loan_amt()
  {
    var vehicle=document.getElementById('vehicle_amount').value;
    var down=document.getElementById('downpayment').value;
    var fcharge=document.getElementById('file_charge').value;
    //var adv_emi=document.getElementById('adv_emi_amt').value;
	if(fcharge=="")
	{
		document.getElementById('file_charge').value=0;
		fcharge==0;
	}
	
    //document.getElementById('lamount').value=parseFloat(vehicle-down)+parseFloat(fcharge)+parseFloat(adv_emi);
      document.getElementById('loan_amount').value=parseFloat(vehicle-down)+parseFloat(fcharge);
    document.getElementById('loan_amount').readOnly=true; 
  }
    
    
function cal_total()
{
  var lamount=document.getElementById('loan_amount').value;
  var month=document.getElementById('loan_month').value;
  var interest=document.getElementById('linterest').value;
  var fcharge=document.getElementById('file_charge').value;


  //var fine=document.getElementById('fine').value;
  var tinterest=(interest)/12;
  //alert(tinterest);
  if(month=='')
  {
	  document.getElementById('loan_month').value=1;
	  month==0;
  }
  
  if(month=='')month==0;
  
  var emi=(parseFloat(lamount)*parseFloat(tinterest))*(parseFloat(month))/100;
  if(emi=='')emi==0;
  var ltotal = parseFloat(lamount)+parseFloat(emi);
  if(ltotal=='')ltotal==0;  
  var total=document.getElementById('ltotal').value=ltotal.toFixed(2);  
  
  document.getElementById('lemi').value=roundNumber((parseFloat(total))/parseFloat(month),2);
  document.getElementById('ltotal').readOnly=true;
   //pre //document.getElementById('ltotal').value=parseFloat(lamount)+parseFloat(lemi)+parseFloat(fcharge)+parseFloat(fine);
    view_interst();
}
    
function view_interst()
{
  var l_amt=document.getElementById('loan_amount').value;
  var interest=document.getElementById('linterest').value;
  var l_month=document.getElementById('loan_month').value;
  var year_int=Math.round((l_amt*interest*l_month)/(100*12));
  var month_int=Math.round(year_int/l_month);
                      var emi=document.getElementById('lemi').value;
  
  var capital=Math.round(emi-month_int);
    if(l_amt=="" && interest=="" && month_int=="")
        document.getElementById('tot_year_interest').innerHTML="";
    else
        document.getElementById('tot_year_interest').innerHTML="Total Interest "+year_int;
  
    if(interest!=0)
        {
        document.getElementById('tot_month_interest').innerHTML="Monthly: Interest "+month_int+" And Capital "+capital;
        document.getElementById('emi_capital').value=+capital;
        document.getElementById('emi_interest').value=+month_int;}
    
  var total_loan=document.getElementById('ltotal').value;
  var downpay=document.getElementById('downpayment').value;
  var ftot_loan=Math.round((parseFloat(total_loan)+parseFloat(downpay)))
  
  if(total_loan!=0)   
      document.getElementById('tot_loan_amt').innerHTML="Total Vehicle Amount "+ftot_loan
}


function roundNumber(num, dec) {
  var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
  return result;
}

//validate customer's phone number    
function check_phone(){
    document.getElementById('textfield3').style.border="";
    var phone=document.getElementById('textfield3').value;
    var mob=phone.trim();
    var length=mob.length;
    if(isNaN(mob)){
        document.getElementById('textfield3').style.border="solid 1px red";
        document.getElementById('sh_phone').innerHTML="Please enter valid Phone number";
    }
    else{
        document.getElementById('sh_phone').innerHTML="";
        if(length!=10 && mob!=""){
            document.getElementById('textfield3').style.border="solid 1px red";
            document.getElementById('sh_phone').innerHTML="Please enter valid Phone number";
        }else{
            document.getElementById('sh_phone').innerHTML="";

        }
    }
    
}

//validate pincode
function check_pincode(){
    document.getElementById('textfield27').style.border="";
    var pin=document.getElementById('textfield27').value;
    var pincode=pin.trim();
    var length=pin.length;
    if(isNaN(pincode)){
        document.getElementById('textfield27').style.border="solid 1px red";
        document.getElementById('sh_pin').innerHTML="Enter valid pincode number";
    }
    else{
        document.getElementById('sh_pin').innerHTML="";
        if(length!=6 && pincode!=""){
                        document.getElementById('textfield27').style.border="solid 1px red";
                        document.getElementById('sh_pin').innerHTML="Enter valid pincode number";
        }else{
            document.getElementById('sh_pin').innerHTML="";

        }
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
                                <h4>Add Customer</h4><hr>
                    <form class="form-sample" id="signupForm" action="customer_insert.php" method="post" enctype="multipart/form-data">
                      <!--<p class="card-description"> Add showroom details </p> -->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Account no</label>
                            <div class="col-sm-9">
                                <div class="mb-3"> 
                                <input type="number" name="acc_no" id="acc_no" class="form-control" placeholder="Enter Account number" value="<?php echo $max_accno; ?>" onblur = "change_status(this.value);" autocomplete="off" required>
                                <small id="showdata"></small>

                                </div>
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
                              <input type="text" name="ctr_name" id="ctr_name" placeholder="Enter Customer name" class="form-control" required autocomplete="off">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <textarea name="ctr_address" id="textarea" rows="3" class="form-control" required></textarea>
                            </div>
                            </div>
                            
                       </div>
                      </div>
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phone no</label>
                            <div class="col-sm-9">
                              <input type="tel" name="ctr_contact" id="textfield3" class="form-control" placeholder="eg. 9876543210" pattern="[0-9]{10}" title="Enter 10 digit valid mobile number" maxlength="10" onblur="check_phone();" required autocomplete="off">
                              <span id="sh_phone" style="color:red;"></span>
                            </div>
                              
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Birth Date</label>
                            <div class="col-sm-9">
                              <input type="date" name="birthday" id="textfield26" placeholder="Enter Custommer name" class="form-control">
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
                                <option value="Palanpur">Palanpur</option>
                                <option value="Mehsana">Mehsana</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                              </select>
                            </div>
                            <label class="col-sm-2 col-form-label">District</label>
                            <div class="col-sm-4">
                                <select name="district" id="select2" class="form-control" required>
                                    <option value="">District</option>
                                    <option value="Banaskantha">Banaskantha</option>
                                    <option value="Mehsana">Mehsana</option>
                                    <option value="Ahmedabad">Ahmedabad</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Pincode</label>
                            <div class="col-sm-6">
                              <input type="tel" name="pincode" id="textfield27" placeholder="eg. 385456" class="form-control" pattern="[0-9]{6}" maxlength="6" title="Enter 6 Digit pincode" autocomplete="off" onblur="check_pincode();" required>
                                <span id="sh_pin" style="color:red;"></span>

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
                                <input type="number" name="vehicle_amount" id="vehicle_amount" placeholder="eg. 50000" class="form-control" required>
                            </div>
                              
                            <label class="col-sm-3 col-form-label">Down Payment</label>
                            <div class="col-sm-3">
                                <input type="number" name="downpayment" id="downpayment" class="form-control" placeholder="eg. 2000" required>
                            </div>
                              
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Loan File Charge</label>
                            <div class="col-sm-3">
                                <input type="number" onkeyup="check_loan_amt()" name="file_charge" id="file_charge" class="form-control" placeholder="eg. 100" required>
                            </div>
                              
                            <label class="col-sm-3 col-form-label">Loan Amount</label>
                            <div class="col-sm-3">
                                <input type="number" name="loan_amount" id="loan_amount" class="form-control" placeholder="eg. 50000" required>
                            </div>  
                          </div>
                        </div>
                      </div>
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Loan Month</label>
                            <div class="col-sm-3">
                                <input type="number" name="loan_month" id="loan_month" class="form-control" placeholder="eg. 12" onblur="cal_total(this.value)" required>
                            </div>
                              
                            <label class="col-sm-3 col-form-label">Loan interest[%]</label>
                            <div class="col-sm-3">
                                <input type="number" name="loan_rate" id="linterest" class="form-control" placeholder="Interest value" onkeyup="cal_total(this.value)" required>
                                <span style="font-size:12px;" class="badge badge-success" id="tot_year_interest"></span>
                            </div> 
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Total Loan</label>
                            <div class="col-sm-9">
                              <input type="number" name="total_loan" id="ltotal" placeholder="Total loan" class="form-control" required>
                              <span style="font-size:12px;" class="badge badge-success" id="tot_loan_amt"></span>
                              <span style="font-size:12px;" class="badge badge-success" id="tot_month_interest"></span>
                              <input type="hidden" name="emi_capital" id="emi_capital" >
                              <input type="hidden" name="emi_interest" id="emi_interest">
                            </div>
                            </div>
                       </div>
                      </div>
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Loan EMI</label>
                            <div class="col-sm-3">
                                <input type="text" name="emi" id="lemi" class="form-control" placeholder="monthly EMI" required>
                               
                            </div>
                              
                            <label class="col-sm-3 col-form-label">Late Fine Charge</label>
                            <div class="col-sm-3">
                                <input type="number" name="fine" id="textfield9" class="form-control" placeholder="Enter Fine" required>
                            </div> 
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Showroom</label>
                            <div class="col-sm-9">
                              <select name="showroom" id="select3" class="form-control" required>
                                <option value="">Select Showroom</option>
                                <?php 
                                  $sql1="SELECT `sh_id`,`sh_name` FROM `showroom`;";
                                  $result1=mysqli_query($link,$sql1);
                                   while($row=mysqli_fetch_array($result1)) {
                                ?>
                                  <option value="<?php echo $row['sh_id']; ?>"><?php echo $row['sh_name']; ?></option> 
                                <?php } ?>  
<!--
                                <option value="TVS showroom">TVS showroom</option>
                                <option value="Honda showroom">Honda showroom</option>
                                <option value="Ather showroom">Ather showroom</option>
                                <option value="Hero showroom">Hero showroom</option>
-->
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Loan Date</label>
                            <div class="col-sm-9">
                              <input type="date" name="loan_date" id="textfield11" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">First EMI date</label>
                            <div class="col-sm-9">
                              <input type="date" name="first_emi_date" id="textfield12" class="form-control" required>
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
                                <input type="text" name="v_reg_no" id="textfield13" placeholder="eg. GJ 01 AB 4420" class="form-control" pattern="[A-Z|a-z]{2}\s?[0-9]{1,2}\s?[A-Z|a-z]{1,2}\s?[0-9]{1,4}" title="Enter valid engine number" required autocomplete="off">
                            </div>
                              
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Chassis number</label>
                            <div class="col-sm-9">
                                <input type="text" name="ch_no" id="textfield14" class="form-control" placeholder="Enter chassis number" required autocomplete="off">
                            </div>  
                          </div>
                        </div>
                      </div>
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Engine no</label>
                            <div class="col-sm-3">
                                <input type="text" name="eng_no" id="textfield15" class="form-control" placeholder="Enter Engine number" required autocomplete="off">
                            </div>
                              
                            <label class="col-sm-2 col-form-label">Model</label>
                            <div class="col-sm-4">
                                <input type="text" name="model" id="textfield16" class="form-control" placeholder="Model name" required autocomplete="off">
                            </div> 
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Other</label>
                            <div class="col-sm-9">
                                <input type="text" name="other" id="textfield7" class="form-control" autocomplete="off"> 
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
                              <input type="text" name="gtr_name" id="textfield18" class="form-control" placeholder="Enter Gurantor name" required autocomplete="off">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Gurantor Contact</label>
                            <div class="col-sm-9">
                              <input type="tel" name="gtr_contact" id="textfield18" placeholder="Enter Gurantor contact" pattern="[0-9]{10}" title="Enter 10 digit valid mobile number" maxlength="10" class="form-control" required autocomplete="off">
                            </div>
                            </div>
                        </div>
                      </div>
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gurantor Address</label>
                            <div class="col-sm-9">
                                <textarea name="gtr_address" id="textfield19" cols="30" rows="5" class="form-control" required autocomplete="off"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">File upload</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                        <input type="file" name="gtr_document" id="fileField" class="custom-file-input" required/>
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                                <label style="color:red;">Please upload pdf files only</label>

                            </div>
                              
                        </div>
                       </div>
                      </div>
                        
                    <!-- changes end -->
                        
<!--
                    <div class="form-group">    
                      <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-gradient-info btn-fw-2">Submit</button>
                            <button type="button" class="btn btn-light" onclick="window.location.href='customers.php'">Back</button>
                          </div>
                        </div>
                      </div>
-->                 <div class="btn-container">
                        <button type="submit" class="btn btn-primary ">
                                <span class="btn-inner--icon"><i class="fa fa-file-text"></i></span> Submit
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