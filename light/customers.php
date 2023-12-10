<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";


?>
<script>
function change_status(val){    
	$.ajax({
		url:"check_account.php",
		type:"post",
		data:{val:val},
		success:function(result) {
			//alert(result);
            $('#showdata').html(result);
		}
	});
}
</script>
    <script>
function del_village(id)
{
	document.getElementById('delbtn').innerHTML=
	'<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" onClick=document.location.href="delete_customer.php?id='+id+'">Confirm</button>';
    
    }

//To print customers or download excel reports        
function print_customers(type){
    //alert(type);
    window.open("customer_print.php?type="+type, '_blank');
}

        
function print_details(val){
    //alert(val);
    window.open("print_customer_details.php?val="+val, '_blank');
}        
        
function print_noc(val){
    //alert(val);
    window.open("print_noc.php?acc="+val, '_blank');

}        

function print_hp(val){
    //alert(val);
    window.open("print_hp.php?acc="+val, '_blank');

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
                                <h4>Customers</h4><hr>
                                
                                
                                <a href="add_customer.php"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>  Add Customer</button></a>

                                <button type="button" class="btn btn-warning btn-sm" onclick="print_customers('P');"><i class="fa fa-print"></i> Print</button>

                                <button type="button" class="btn btn-slack btn-sm" onclick="print_customers('E');"><i class="fa fa-file-excel-o"></i> Excel</button>
                                
                                  
                              
                                
                                
                                

                                <div class="input-group mb-3"> </div>
                                <table class="table table-bordered table-striped table-hover" id="example1">
                                <thead>
                                <tr>
                                    <th> Acc no. </th>
                                    <th> Name </th>
                                    <th> Date </th>
                                    <th> Contact </th>
                                    <th> Loan amount </th>
                                    <th> Action</th>    
                                </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    if($search!=''){
                                       $sql="select * from customer WHERE name LIKE '$search%' or acc_no LIKE '$search%'";
                                    }
                                    else{
                                       $sql="select * from customer";
                                    }
                                    //$sql= "SELECT `acc_no`,`name`,`mob_no`,`loan_amount`,`total_loan`,`city`,`district` FROM `customer`";
                                    $result=mysqli_query($link,$sql);
                                      while($row=mysqli_fetch_array($result)){
                                      ?>	  
                                      <tr>
                                        <td><?php echo $row['acc_no']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($row['loan_date'])); ?></td>
                                        <td><?php echo $row['mob_no']; ?></td>
                                        <td><?php echo $row['loan_amount']; ?></td>
                                        <td>
                                            
                                        <a href="https://web.whatsapp.com/send?phone='91<?php echo $row['mob_no']; ?>'"><button class="btn btn-success btn-icon-only" type="button"><i class="fa  fa-whatsapp"></i></button></a>
                                            
                                        <button type="button" class="btn btn-danger btn-icon-only" data-toggle="modal" data-target="#modal_5" onclick="del_village(<?php echo $row['acc_no']; ?>);"><span class="btn-inner--icon"><i class="fa fa-trash-o"></i></span></button>
                                            
                                        <a href="update_customer.php?id=<?php echo $row['acc_no']; ?>"><button type="button" class="btn btn-primary btn-icon-only"><span class="btn-inner--icon"><i class="fa  fa-edit"></i></span></button></a>
                                        
                                        <button type="button" class="btn btn-warning btn-icon-only" onclick="print_details(this.value);" value="<?php echo $row['acc_no']; ?>"><span class="btn-inner--icon"><i class="fa fa-print"></i></span></button>
                                        
                                        <a href="customer_payment.php?customer=<?php echo $row['acc_no']; ?>"><button type="button" class="btn btn-facebook btn-icon-only"><span class="btn-inner--icon"><i class="fa  fa-rupee"></i></span></button></a>    
                                            
                                        <?php if($row['loan_clear']=='Yes'){?><button type="button" class="btn btn-youtube btn-sm" onclick="print_noc(this.value);" value="<?php echo $row['acc_no']; ?>">NOC</button> <?php } ?> 
                                            
                                        <button type="button" class="btn btn-twitter btn-sm" onclick="print_hp(this.value);" value="<?php echo $row['acc_no']; ?>">HP</button>  
                                            
                                        <?php if($row['wh_back']=="Yes"){ ?><span class="btn-inner--icon"><button type="button" class="btn btn-secondary btn-icon-only rounded-circle"><span class="btn-inner--icon"><i class="fa fa-truck"></i></span></button></span> <?php } ?>
                                            
                                    <div class="modal modal-danger fade" id="modal_5" tabindex="-1" role="dialog" aria-labelledby="modal_5" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal_title_6">Delete Customer</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="py-2 text-center">
<!--                                                <i class="fa fa-exclamation-circle fa-4x"></i>-->
                                                <h6 class="heading">Do you really want delete this party?</h6>
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