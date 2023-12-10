<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";

$inst_num=trim($_REQUEST['inst_num']);
$cur_date=date('Y-m-d');

?>

<script>
function check_acc(){    
    var inst_num=document.getElementById('inst_num').value;
    if(inst_num.trim()==""){
        //document.getElementById('vehicle').value.trim();
        alert("Enter Installment number");
    }
}
</script>       

    <div class="main_content" id="main-content">
        <div class="page">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task">
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
                                        <input type="text" class="form-control" name="inst_num" id="inst_num" placeholder="Number of  installments" autocomplete="off" value="<?php echo $inst_num; ?>" required>
                                        <div class="input-group-btn ml-3">
                                        <div class="btn-group" role="group">
                                            <button type="submit" class="btn btn-primary"><span class=" fa fa-search" aria-hidden="true"></span> Search</button>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>  
                                </form>   
                                </div>
                        </div>
                    </div>
                </div>
                     
                                <?php if($inst_num!=""){ ?>                                                  
                           <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                              <div class="card planned_task">
                                                          <div class="body">
                                                          <h4>Installment Remaining Customer List</h4><hr>
                                
                                <table class="table table-bordered table-striped table-hover" id="example1">
                                <thead>
                                <tr>
                                    <th> Acc no. </th>
                                    <th> Name </th>
                                    <th> Address </th>
                                    <th> Contact </th>
                                    <th> Loan amount </th>
                                    <th> Vehicle </th>
                                    <th> Vehicle Number </th>
                                    <th> EMI </th>
                                    <th> total Remaining</th>
                                </tr>
                                </thead>
                                    <tbody>
                                  <?php 
                                    
                                    $query="select * from customer WHERE `loan_clear`='No' ";    
                                    $result=mysqli_query($link,$query);
                                      while($row=mysqli_fetch_array($result)){
                                          
                                          list($count)=mysqli_fetch_array(mysqli_query($link,"select count(*) from cust_inst_record where inst_clear='No' and inst_date<='$cur_date' and acc_no='$row[acc_no]'"));
                                          //echo $count;
                                          if($count==$inst_num){
//count paid emis amount from payment	  
  list($emi)=mysqli_fetch_array(mysqli_query($link,"select sum(amount) from payment where acc_no='$row[acc_no]' and emi_date<='$cur_date'"));
//count installments less than current date
  list($count_emi)=mysqli_fetch_array(mysqli_query($link,"select count(*) from cust_inst_record where inst_date<='$cur_date' and acc_no='$row[acc_no]'"));
//
  $emiamount=round(($row['emi']*$count_emi)-$emi,2); 
                                      ?>	  
                                      <tr>
                                        <td><?php echo $row['acc_no']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['mob_no']; ?></td>
                                        <td><?php echo $row['loan_amount']; ?></td>
                                        <td><?php echo $row['model']; ?></td>
                                        <td><?php echo $row['vehicle_reg_no']; ?></td>
                                        <td><?php echo $row['emi']; ?></td>
                                        <td><?php echo $emiamount; ?></td>
                                       <?php } }
                                      ?>
                                  </tr>
                                </tbody>    
                                </table>
                                                  </div>
                                        </div>
                               </div>
                </div>
                  <?php } ?>              
            </div>
        </div>    
    </div>
    
<?php include "footer.php"; ?>