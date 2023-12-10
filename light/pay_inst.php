<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";

$acc=$_GET['acc_no'];
$inst=$_GET['inst'];
$emi_date=$_GET['date'];

$sql="select * from customer where acc_no='$acc'";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_array($result);

list($fine1)=mysqli_fetch_array(mysqli_query($link,"SELECT `fine` FROM `customer` WHERE `acc_no`='$acc'"));

                         

?>
<script>
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
<script type="text/javascript">  
  $(document).ready(function() {
    sum();
    $("#emi_capital, #emi_inst").on("keydown keyup", function() {
        sum();
    });
});

function sum() {
    var num1 = document.getElementById('emi_capital').value;
    var num2 = document.getElementById('emi_inst').value;
    var result = parseFloat(num1) + parseFloat(num2);
  
    if (!isNaN(result)) {
        document.getElementById('emi_amount').value = result;       
    }
    
   
}
     function dueday(datea){
         
         
    var date2=new Date(datea);
    var date1=new Date(document.getElementById('emi_date').value);
    if(date1<date2) {
    var Difference_In_Time = date2.getTime() - date1.getTime();
    var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
    document.getElementById('show_due_days').innerHTML="Due Days: "+Difference_In_Days;
    
    var fine_amount= document.getElementById('fine_amount').value;
    var calc= Difference_In_Days * fine_amount;
    document.getElementById('fine').value=calc;
        document.getElementById('fine_amount_span').innerHTML="Fine Amount :- "+calc;
    
    }
         else{
             
             document.getElementById('show_due_days').innerHTML="Due Days: "+0;
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
                                <h4>Customer Payment </h4>
                                <div class="row">
                                <div class="col-sm-9">                              
                              <span style="font-size:12px;" class="badge badge-warning" id="acc_no">Account No :- <?php echo $acc; ?></span>
                              <span style="font-size:12px;" class="badge badge-primary" id="name">Name :- <?php echo $row['name']; ?> </span>
                              <span style="font-size:12px;" class="badge badge-danger" id="fine_amount_span"></span>
                            </div>
                               </div>
                                
                                <hr>
                            <form class="form-sample" action="pay_inst_exe.php" method="POST">
                      <!--<p class="card-description"> Add showroom details </p> -->
                      
                      
            
                            <div class="row">
                                    <div class="col-md-3">
                                        <label for="basic-url">Date</label>
                                        <div class="mb-3">
                                            <input type="date" name="paydate" id="paydate" class="form-control" value="<?php echo date('Y-m-d'); ?>" required onblur="dueday(this.value);">
                                            
                                            
                                            <span style="color:#FFF; background-color:#105D15; font-size:14px; padding-left:10px; padding-right:10px;" id="show_due_days"></span>
                                             
                                             
                                              <input type="hidden" name="acc" value="<?php echo $acc; ?>">
                                              <input type="hidden" name="inst" value="<?php echo $inst; ?>">
                                              <input type="hidden" name="emi_date" id="emi_date" value="<?php echo $emi_date; ?>">
                                        </div>  
                                    </div>
                                    <div class="col-md-3">
                                        <label for="basic-url">Capital</label>
                                        <div class="mb-3">
                                            <input type="text" name="capital" id="emi_capital" class="form-control" placeholder="Enter capital amount" value="<?php echo $row['emi_capital']; ?>" required onblur="sum();">
                                        </div>  
                                    </div>
                                    <div class="col-md-3">
                                        <label for="basic-url">Interest</label>
                                        <div class="mb-3">
                                            <input type="text" name="interest" id="emi_inst" class="form-control" placeholder="Enter interest amount" required onblur="sum();" value="<?php echo $row['emi_interest']; ?>">
                                        </div>  
                                    </div>
                                    <div class="col-md-3">
                                        <label for="basic-url">emi</label>
                                        <div class="mb-3">
                                            <input type="text" name="emi" id="emi_amount" class="form-control" placeholder="EMI amount" required readonly>
                                        </div>  
                                    </div>
                                </div>
                            <div class="row">
                                    <div class="col-md-3">
                                        <label for="basic-url">Fine Rs.</label>
                                        <div class="mb-3">
                                            <input type="text" name="fine" id="fine" class="form-control" placeholder="Fine Amount">
                                            <input type="hidden" name="fine_amount" id="fine_amount" value="<?php echo $fine1;  ?>">
                                        </div>  
                                    </div>
                                    <div class="col-md-3">
                                        <label for="basic-url">Payment Type</label>
                                        <br>
                                        <div class="custom-control custom-radio inline-cr">
                                            <input type="radio" name="type1" class="custom-control-input" id="cash" value="cash" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="type" onchange="showbankdetails(this.value);">
                                            <label class="custom-control-label" for="cash">Cash</label>
                                        </div>
                                        <div class="custom-control custom-radio inline-cr">
                                            <input type="radio" name="type1" class="custom-control-input" id="cheque" value="cheque" data-parsley-multiple="type" onchange="showbankdetails(this.value); " checked>
                                            <label class="custom-control-label" for="cheque"  >Cheque</label>
                                        </div>
                                        <p id="error-radio"></p>  
                                    </div>
                                    <div class="col-md-3">
                                        <label for="basic-url">Loan Clear</label>
                                        <br>
                                        <div class="custom-control custom-radio inline-cr">
                                            <input type="radio" name="type3" class="custom-control-input" id="no" value="no" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="type" checked>
                                            <label class="custom-control-label" for="no">No</label>
                                        </div>
                                        <div class="custom-control custom-radio inline-cr">
                                            <input type="radio" name="type3" class="custom-control-input" id="yes" value="yes" data-parsley-multiple="type">
                                            <label class="custom-control-label" for="yes" >Yes</label>
                                        </div>
                                        <p id="error-radio"></p>  
                                    </div>
                                </div>
                            <div id="bank" >    
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
                                            <input type="date" name="c_date" id="c_date" class="form-control" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
                                        </div>

                                    </div>
                                </div> 
                                </div>    
                        
                        <!-- changes start -->
                        
                    <div class="btn-container">
                        <button type="submit" class="btn btn-primary ">
                                <span class="btn-inner--icon"><i class="fa fa-refresh"></i></span> Save
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="history.back();">
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