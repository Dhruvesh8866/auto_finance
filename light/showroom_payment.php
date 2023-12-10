<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";    

$from=$_REQUEST['from'];
$to=$_REQUEST['to'];

?>
<script>
function del_village(id)
{
	document.getElementById('delbtn').innerHTML=
	'<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" onClick=document.location.href="showroom_payment_delete.php?id='+id+'">Confirm</button>';
    
}
function print_showroom_payment(type){
    //alert(type);
    var from=document.getElementById('from').value;
    var to=document.getElementById('to').value;
    window.open("showroom_payment_print.php?type="+type+"&from="+from+"&to="+to, '_blank');
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
                                
                                
                                
                                <h4>Showroom Payment</h4><hr>
                                
                                <a href="pay_showroom.php"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>  Pay Showroom</button></a>

                                <button type="button" class="btn btn-warning btn-sm" onclick="print_showroom_payment('P');"><i class="fa fa-print"></i> Print</button>

                                <button type="button" class="btn btn-slack btn-sm" onclick="print_showroom_payment('E');"><i class="fa fa-file-excel-o"></i> Excel</button>
                                
                                
                                
                              
                                <div class="mb-3"></div>                                
                                <div class="input-group mb-3"></div>
                                <form class="form-sample" method="POST" >

                                <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><b>From</b></label>
                                        <div class="col-sm-10">
                                          <input type="date" name="from" id="from" class="form-control" value="<?php echo $from; ?>">
                                        </div>

                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                          <div class="form-group row"> 
                                            <label class="col-sm-2 col-form-label"><b>To</b></label>
                                            <div class="col-sm-10">
                                              <input type="date" name="to" id="to" class="form-control" value="<?php echo $to; ?>">
                                            </div>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-facebook" onclick="print_customers('E');"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                                </form>
                                <div class="input-group mb-3"></div>

                                <table class="table table-bordered table-striped table-hover" id="example1">
                                <thead>
                                <tr>
                                    <th> No. </th>
                                    <th> Date </th>
                                    <th> Showroom </th>
                                    <th> Acc no. </th>
                                    <th> Name </th>
                                    <th> Amount </th>
                                    <th> Action</th>    
                                </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    
                                    if($from!="" && $to!=""){
                                    $sql="SELECT sp.sh_payid,sp.pay_date,sp.acc_no,sp.amount,c.name,s.sh_name FROM showroom_payment sp JOIN customer c ON sp.acc_no=c.acc_no JOIN showroom s ON sp.sh_id=s.sh_id WHERE pay_date BETWEEN '$from' AND '$to'";
                                    }
                                    else{
                                        $sql="SELECT sp.sh_payid,sp.pay_date,sp.acc_no,sp.amount,c.name,s.sh_name FROM showroom_payment sp JOIN customer c ON sp.acc_no=c.acc_no JOIN showroom s ON sp.sh_id=s.sh_id";
                                    }
                                   
                                    //$sql= "SELECT `acc_no`,`name`,`mob_no`,`loan_amount`,`total_loan`,`city`,`district` FROM `customer`";
                                    $result=mysqli_query($link,$sql);
                                      while($row=mysqli_fetch_array($result)){
                                      ?>	  
                                      <tr>
                                        <td><?php echo $row['sh_payid']; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($row['pay_date'])); ?></td>
                                        <td><?php echo $row['sh_name']; ?></td>
                                        <td><?php echo $row['acc_no']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['amount']; ?></td>
                                        <td><button type="button" class="btn btn-danger btn-icon-only rounded-circle" data-toggle="modal" data-target="#modal_5" onclick="del_village(<?php echo $row['sh_payid']; ?>);"><span class="btn-inner--icon"><i class="fa fa-trash-o"></i></span></button>
                                            
                                            
                                        <a href="showroom_payment_update.php?id=<?php echo $row['sh_payid']; ?>"><button type="button" class="btn btn-primary btn-icon-only rounded-circle"><span class="btn-inner--icon"><i class="fa  fa-edit"></i></span></button></a>
                                    
                                            
                                        <div class="modal modal-danger fade" id="modal_5" tabindex="-1" role="dialog" aria-labelledby="modal_5" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal_title_6">Delete Record</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="py-2 text-center">
<!--                                                <i class="fa fa-exclamation-circle fa-4x"></i>-->
                                                <h6 class="heading">Do you really want delete this Record?</h6>
                                                </div>
                                            </div>
                                            <div class="modal-footer" id="delbtn">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>     
                                        </td>
                                       <?php  }
                                      ?>
                                  </tr>
                                </tbody>    
                                </table>

                            
                                
                                

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