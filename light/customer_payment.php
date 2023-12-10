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
//mysqli_query($link,$check_loan);
//if(mysqli_affected_rows($link)>0)
//{
//        $_SESSION['success']="<b>Loan Clear!</b><br>Loan amount is paid by this customer";
//
//}
//$check_hold="SELECT `wh_back`='Yes' FROM `customer` WHERE `acc_no`='$search'";
//mysqli_query($link,$check_hold);
//if(mysqli_affected_rows($link)>0)
//{
//        $_SESSION['fail']="<b>Withhold Vehicle!</b> <br>This customer's vehicle is taken back";
//
//}
?>

<script>

    function print_emi_details(val){
    //alert(val);
    var acc=document.getElementById('customer').value;
    if(acc==""){
        alert("Please select any customer");
    }    
    else{    
    //alert(acc);
    window.open("print_emi_details.php?type="+val+"&acc="+acc, '_blank');
    }
}

</script>

<div class="main_content" id="main-content">
  <div class="page">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
          <div class="card planned_task">
              
        
            <div class="body">
                
              <form class="forms-sample" method="get">
                <h4>Customer Payment</h4>
                <hr>
                  
                 

                <button type="button" class="btn btn-warning btn-sm" onclick="print_emi_details('P');"><i class="fa fa-print"></i> Print</button>

                <button type="button" class="btn btn-slack btn-sm" onclick="print_emi_details('E');"><i class="fa fa-file-excel-o"></i> Excel</button>
                                
                <div class="input-group mb-3"> </div> 
                  
                <div class="row">
                  <div class="col-md-6"> <b>
                    <label for="basic-url">Account</label>
                    </b>
                    <div class="input-group" id="adv-search">
                      <select name="customer" id="customer" class="form-control" required>
                        <option value="">Select Account</option>
                        <?php 
							$sql1="SELECT `acc_no`,`name` FROM `customer`;";
							$result1=mysqli_query($link,$sql1);
							while($row=mysqli_fetch_array($result1)) {
								?>
                        <option value="<?php echo $row['acc_no']; ?>" <?php if($row['acc_no']==$_GET['customer']) echo 'selected'; ?> >[<?php echo $row['acc_no']; ?>] <?php echo $row['name']; ?> </option>
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
              <div class="card" >
                <div class="header">
                  <h2>Customer List</h2>
                </div>
                <div class="body">
                  <div class="table-responsive">
                    <table class="table table-hover mb-0 c_list">
                      <thead>
                        <tr>
                          <th> No </th>
                          <th>EMI Date</th>
                          <th>EMI</th>
                          <th>Date</th>
                          <th>Pay Amount</th>
                          <th>Pay</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php                                         
                                                        
						$row=mysqli_fetch_array(mysqli_query($link,"select * from customer WHERE acc_no='$search'"));    
						$i=0;
						$total_pay=0;
						$total=0;
						for($j=$i;$j<$row['loan_month'];$j++){
														
						 $date1=date('d-m-Y',strtotime('+'.$j.' Month '.$row['first_emi_date']));
                         $date2=date('Y-m-d',strtotime($date1));	
						 list($pid,$pay_amount,$paydate,$instnum,$capital,$inst)=mysqli_fetch_array(mysqli_query($link,"select p_id,sum(amount),pay_date,inst_no,emi_capital,emi_interest from payment where acc_no='$_GET[customer]' and inst_no='".($j+1)."'"));
						 
						 list($clear,$emi)=mysqli_fetch_array(mysqli_query($link,"select `inst_clear`,emi from `cust_inst_record` WHERE `acc_no`='$_GET[customer]' and `inst_no`='".($j+1)."' and `inst_date`='$date2'"));	
						 				
						?>
                        <tr>
                          <td><?php echo $j+1;?></td>
                          <td><?php echo $date1; ?></td>
                          <td><?php echo $row['emi']; ?></td>
                          <td><?php if($paydate!=''){ echo date('d-m-Y',strtotime($paydate));} ?></td>
                          <td><?php echo $pay_amount;?></td>
                          <td>
                             <?php 
							
							 if($clear=="Yes") {   
							 
							 $no =($j+1);
							  list($last_inst,$instno)=mysqli_fetch_array(mysqli_query($link,"SELECT `inst_clear`,inst_no FROM `payment` WHERE `acc_no`='$_GET[customer]' order by `inst_no` DESC"));								
							  ?>
                              
                             <a class="btn btn-sm btn-primary"  href="payreceipt.php?pid=<?php echo $no; ?>&accno=<?php echo $row['acc_no']; ?>" target="_blank" ><i class="fa fa-print" aria-hidden="true"></i> </a>
                             
                                <?php  
								if($instno == $no){ ?>
    
                              <a class="btn btn-sm btn-danger" href="delete_inst.php?acc_no=<?php echo $row['acc_no']; ?>&edate=<?php echo $date1; ?>&inst=<?php echo $j+1; ?>" onClick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-times" aria-hidden="true"></i></a> 
                              
                              
                              
                            <?php } ?>
                            
                            <?php } else { 
							
							   $no =($j+1);						
							  list($last_inst,$instno)=mysqli_fetch_array(mysqli_query($link,"SELECT `inst_clear`,inst_no FROM `payment` WHERE `acc_no`='$_GET[customer]' order by `inst_no` DESC"));
							  if($instno == "") $instno = 1; else $instno = $instno + 1; 
						
							  if($instno == $no){?>
							
                              <a class="btn btn-sm btn-success" href="pay_inst.php?acc_no=<?php echo $row['acc_no']; ?>&inst=<?php echo $j+1; ?>&date=<?php echo date('Y-m-d',strtotime($date1)); ?>">Pay</a>
<!--							  <button type='button' class="btn btn-sm btn-success" onclick="pay_inst('<?php echo $row['acc_no']; ?>','<?php echo $date1;?>','<?php echo $j+1;?>');"> Pay </button>-->
							  <?php } 
							  
							}?>
                          </td>
                        </tr>
                        <?php  $total= $total + $row['emi']; 
                        $total_pay= $total_pay + $pay_amount;}  ?>
                          <tr>
                            <td></td>
                            <td></td>
                            <td><b>Total: </b><br><b><?php echo round($total); ?></b></td>
                              <td></td>
                            <td><b>Remaining: </b><br><b><?php echo round($total - $total_pay); ?></b></td>
                            <td></td>

                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
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