<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";

$search=$_REQUEST['customer'];
list($check_loan,$check_hold)=mysqli_fetch_array(mysqli_query($link,"SELECT `loan_clear`,`wh_back` FROM `customer` WHERE `acc_no`='$search'"));
if($check_loan=="Yes"){
    $_SESSION['clear']="<b>Loan Clear!</b><br>Loan amount is paid by this customer";
}
if($check_hold=="Yes"){
    $_SESSION['hold']="<b>Withhold Vehicle!</b> <br>This customer's vehicle is taken back";
}
?>
<script>
function myFunction() {
  var x = document.getElementById("emi_list");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
    function showbankdetails(val){
    if(val=='cash'){
        document.getElementById('bank').style.display='none';
        document.getElementById('c_number').required=false;
        document.getElementById('c_date').disabled=true;

    }
    else{
        document.getElementById('bank').style.display='block';

        document.getElementById('c_date').required=true;
        document.getElementById('c_number').required=true;
        
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
              <form class="forms-sample" method="get">
                <h4>Fine Payment</h4>
                <hr>
                <div class="row">
                  <div class="col-md-6"> <b>
                    <label for="basic-url">Account</label>
                    </b>
                    <div class="input-group" id="adv-search">
                      <select name="customer" id="customer" class="form-control"   required>
                        <option value="">Select Account</option>
                        <?php 
                                                $sql1="SELECT `acc_no`,`name` FROM `customer`;";
                                                $result1=mysqli_query($link,$sql1);
                                                while($row=mysqli_fetch_array($result1)) {
                                                    ?>
                        <option value="<?php echo $row['acc_no']; ?>" <?php if($row['acc_no']==$_GET['customer']) echo 'selected'; ?>>[<?php echo $row['acc_no']; ?>] <?php echo $row['name']; ?> </option>
                        <?php } ?>
                      </select>
                      <div class="input-group-btn ml-3">
                        <div class="btn-group" role="group">
                          <button type="submit" class="btn btn-primary "><span class=" fa fa-search" aria-hidden="true"></span> Search</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <div class="mb-3"></div>
                
                <?php if(isset($_SESSION['clear']) && $_SESSION['clear']==true){ ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['clear'];?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                            <?php } unset($_SESSION['clear']); ?>
                            
                            <?php if(isset($_SESSION['hold']) && $_SESSION['hold']==true){ ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['hold'];?>    
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                            <?php } unset($_SESSION['hold']); ?>
                
                
              <?php if($search!=""){
                ?>
              <div class="row">
                <div class="col-md-6 ">
                  <?php 
                    $result2=mysqli_fetch_array(mysqli_query($link,"select `acc_no`,`name`,`address`,`mob_no` from customer WHERE acc_no='$search'"));    
                                                        

                    ?>
                  <strong class="col-6">Account No : </strong><span><?php echo $result2['acc_no']; ?></span><br>
                  <!--                                       <label class="col-sm-3 col-form-label">Account no</label><span class="ml-1 " ><?php echo $result2['acc_no']; ?></span><br>--> 
                  
                  <strong class="col-6">Customer Name : </strong><span><?php echo $result2['name']; ?></span> </div>
                <div class="col-md-6"> <strong class="col-6">Address : </strong><span><?php echo $result2['address']; ?></span><br>
                  <strong class="col-6">Contact : </strong><span><?php echo $result2['mob_no']; ?></span> </div>
              </div>
            <div class="input-group mb-3"></div>
             <div class="card">            

                <div class="header" onclick="myFunction()">
                  <h6><?php echo $result2['name']; ?>  EMI List</h6>
                  <i class="fa fa-plus" ></i>
                </div>
                <div class="body p-0" id="emi_list" style="display:none;">
                  <div class="table-responsive">
                   <table class="table table-hover mb-0 c_list">
          <thead>
            <tr>
              <th>No</th>
              <th>Emi Date</th>
              <th>Emi</th>
              <th>Date</th>
              <th>Pay Amount </th>
                            <th>Due Day </th>
            </tr>
          </thead>
          <tbody>
                       <?php                                         
                                                        
						$row3=mysqli_fetch_array(mysqli_query($link,"select * from customer WHERE acc_no='$search'"));    
						$i=0;
						$due_day=0;
						$total=0;
						for($j=$i;$j<$row3['loan_month'];$j++){
														
						 $date1=date('d-m-Y',strtotime('+'.$j.' Month '.$row3['first_emi_date']));
                         $date2=date('Y-m-d',strtotime($date1));
                            
						 list($pid,$pay_amount,$paydate,$instnum,$capital,$inst)=mysqli_fetch_array(mysqli_query($link,"select p_id,sum(amount),pay_date,inst_no,emi_capital,emi_interest from payment where acc_no='$_GET[customer]' and inst_no='".($j+1)."'"));
						 
						 list($clear,$emi)=mysqli_fetch_array(mysqli_query($link,"select `inst_clear`,emi from `cust_inst_record` WHERE `acc_no`='$_GET[customer]' and `inst_no`='".($j+1)."' and `inst_date`='$date2'"));
                            
                        
				            
						?>
                        <tr>
              <td><?php echo $j+1;?></td>
              <td><?php echo $date1; ?></td>
              <td><?php echo $row3['emi']; ?></td>
              <td><?php if($paydate!=''){ echo date('d-m-Y',strtotime($paydate));} ?></td>
              <td><?php echo $pay_amount;?></td>
              <td><?php
                         
              $date1;
			 
			 if($paydate=='')
			 {
				 $paydate=$date1;
			 }
			 
			  $date2=$paydate;
							
			
			 $next_due_date = strtotime($date1);
			$now = strtotime($date2);			
			$time_day=($next_due_date-$now)/86400 ;  
			 
			 if($time_day > 0) 
			 { 
			     $tot_day = '0';
			 }
			 else
			 { 
			 	 $tot_day = $time_day;
			 
			 }
                 echo abs(round($tot_day,0));       
                            
                // $row4=mysqli_fetch_array(mysqli_query($link,"SELECT pay_date,emi_date,DATEDIFF(pay_date, emi_date) AS day FROM payment WHERE pay_date > emi_date;")); 
               // echo $row4['day']; 
                            
                             ?></td>
            </tr>
              
            
             
              
            <?php  $total= $total + $row3['emi']; 
                        $due_day= $due_day + abs(round($tot_day,0));}  ?>
                          <tr>
                            <td><b>Total</b></td>
                            <td></td>
                            <td><b><?php echo round($total); ?></b></td>
                              <td></td>
                            <td></td>
                            <td><b><?php echo $due_day; ?></b></td>

                          </tr>
          </tbody>
        </table> 
                    </div>
                    
                </div>
                </div>
                
                <hr>
                 <div class="card">            

                <div class="header">
                  <h6>Fine Payment Details</h6>
                </div>
                
                <?php 
                list($fine1)=mysqli_fetch_array(mysqli_query($link,"SELECT `fine` FROM `customer` WHERE `acc_no`='".$result2['acc_no']."'"));
                $total_fine=$due_day * $fine1;
                //fetching sum of paid fine from payment table and removing it from total fine
                list($final_fine)=mysqli_fetch_array(mysqli_query($link,"SELECT SUM(`fine`) FROM `payment` WHERE `acc_no`='".$result2['acc_no']."'"));
                $last_fine=$total_fine - $final_fine;
                     ?>     
                     
                <form class="form-sample" id="signupForm" action="fine_payment_insert.php" method="post" enctype="multipart/form-data">
                <div class="body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="basic-url">Date</label>
                                <div class="mb-3">
                                    <input type="date" name="fpaydate" id="fpaydate" class="form-control" value="<?php echo date('Y-m-d'); ?>" required readonly>
                                    <input type="hidden" name="acc_no" value="<?php echo $result2['acc_no']; ?>">
                                </div>  
                        </div>
                        <div class="col-md-3">
                            <label for="basic-url">Remaining Fine Amount</label>
                            <div class="mb-3">
                                    <input type="text" name="famount" id="famount" value="<?php echo $last_fine; ?>" class="form-control" placeholder="Fine Amount" required readonly> 
                            </div> 
                        </div>
                        <div class="col-md-3">
                            <label for="basic-url">Loan Clear</label>
                            <br>
                            <div class="custom-control custom-radio inline-cr">
                                <input type="radio" name="type2" class="custom-control-input" id="no" value="No" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="type" checked> 
                                <label class="custom-control-label" for="cash">No</label>
                            </div>
                            <div class="custom-control custom-radio inline-cr">
                                <input type="radio" name="type2" class="custom-control-input" id="yes" value="Yes" data-parsley-multiple="type">
                                <label class="custom-control-label" for="cheque" >Yes</label>
                                </div>
                                <p id="error-radio"></p>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                        <label><b>Payment Type</b></label>
                                        <br>
                                        <div class="custom-control custom-radio inline-cr">
                                            <input type="radio" name="type1" class="custom-control-input" id="cash" value="cash" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="type" onchange="showbankdetails(this.value);">
                                            <label class="custom-control-label" for="cash">Cash</label>
                                        </div>
                                        <div class="custom-control custom-radio inline-cr">
                                            <input type="radio" name="type1" class="custom-control-input" id="cheque" value="cheque" data-parsley-multiple="type" onchange="showbankdetails(this.value);" checked>
                                            <label class="custom-control-label" for="cheque" >Cheque</label>
                                        </div>
                                        <p id="error-radio"></p>
                                    </div>
                        </div>
                    </div>
                    
                    <div id="bank">    
                        <div class="row" >
                            <div class="col-md-3">
                                <label for="basic-url">Cheque Number</label>
                                <div class="mb-3">
                                    <input type="text" name="c_number" id="c_number" placeholder="Enter Cheque number" class="form-control" autocomplete="off">
                                </div>
                            </div>
                                    
                            <div class="col-md-3">
                                <label for="basic-url">Cheque date</label>
                                <div class="mb-3">
                                    <input type="date" name="c_date" id="c_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                </div>

                            </div>
                        </div> 
                    </div>
                    
                    <div class="btn-container">
                        <button type="submit" class="btn btn-primary ">
                            <span class="btn-inner--icon"><i class="fa fa-key"></i></span> Save
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="history.back()">
                            <span class="btn-inner--icon"><i class="fa fa-arrow-left"></i></span> Back
                        </button> 
                    </div>
                </div>
                </form>
                </div>
                
             
              <?php } ?>
              
             
              
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