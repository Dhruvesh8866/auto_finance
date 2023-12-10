<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";


?>
     <script>
function del_village(id)
{
	document.getElementById('delbtn').innerHTML=
	'<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" onClick=document.location.href="delete_fine_payment.php?fid='+id+'">Confirm</button>';
    
    }

//To print customers or download excel reports        
function print_payreport(type){
    //alert(type);
     var from =document.getElementById('from').value;
  var to =document.getElementById('to').value;
    window.open("finepayment_report_print.php?type="+type+"&from="+from+"&to="+to, '_blank');
}

</script>

    

    <div class="main_content" id="main-content">
        <div class="page">

            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task">

                           
                            
                            <div class="body">
                                
                            
                                <form class="forms-sample" method="POST">
                                <h4>Fine Payment Report</h4><hr>
                              

                                <button type="button" class="btn btn-warning btn-sm" onclick="print_payreport('P');"><i class="fa fa-print"></i> Print</button>

                                <button type="button" class="btn btn-slack btn-sm" onclick="print_payreport('E');"><i class="fa fa-file-excel-o"></i> Excel</button>
                                                                                                
                              
                                <div class="mb-3"></div>                                
                                <div class="input-group mb-3"></div>

                                <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"><b>From</b></label>
                                        <div class="col-sm-9">
                                          <input type="date" name="from" id="from"  class="form-control" value="<?php echo $_REQUEST['from']; ?>">
                                        </div>

                                      </div>
                                    </div>
                                <div class="col-md-4">
                                  <div class="form-group row"> 
                                    <label class="col-sm-3 col-form-label"><b>To</b></label>
                                    <div class="col-sm-9">
                                      <input type="date" name="to" value="<?php echo date('Y-m-d'); ?>" id="to" class="form-control">
                                    </div>
                                    </div>
                               </div>
                               <div class="col-md-4">
                                    <button type="submit" class="btn btn-facebook"><i class="fa fa-search"></i> Search</button>
                               </div>
                      </div>
                                </form>
                                
                            
                 <div class="input-group mb-3"></div>               
                
                    <table class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline" id="example1">
                      <thead>
                        <tr>
                         <th>Sr No</th>
                          <th>Acc No </th>                          
                          <th>Name</th>
                          <th>Amount</th>
                          <th>Payment Type</th>
                          <th>Date</th>                          
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php                                                                                             
						 $row="select fine_payment.f_id,fine_payment.acc_no,customer.name,fine_payment.amount,fine_payment.type,fine_payment.fine_pay_date FROM fine_payment JOIN customer ON fine_payment.acc_no=customer.acc_no where fine_payment.fine_pay_date BETWEEN '".$_REQUEST['from']."' AND '".$_REQUEST['to']."'";    
                          
                        $result=mysqli_query($link,$row);
                                                        $i=0;
                                                        while( $show1=mysqli_fetch_array($result)) {                                                  
                                                        $i++
                                                        ?>
                                                           
                                                            <tr>
                                                                <td>
                                                               <?php echo $i; ?>                                                      
                                                                </td>
                                                                <td>
                                                                  <?php echo $show1['acc_no']; ?>
                                                                </td>                                                               
                                                                <td>
                                                                  <?php echo $show1['name']; ?>
                                                                </td>
                                                                <td>
                                                                  <?php echo $show1['amount']; ?>
                                                                </td>
                                                                <td>
                                                                  <?php echo $show1['type']; ?>
                                                                </td>
                                                                <td>
                                                                  <?php echo date('d-m-Y',strtotime($show1['fine_pay_date'])); ?>
                                                                </td>                                                               
                                                                <td>
                                                                  
                                                                   <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal_5" onclick="del_village(<?php echo $show1['f_id']; ?>);">
                                                                   <span class="btn-inner--icon"><i class="fa fa-trash-o"></i></span>
                                                                      </button>
                                                                      
                                                                       <div class="modal modal-danger fade" id="modal_5" tabindex="-1" role="dialog" aria-labelledby="modal_5" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal_title_6">Delete Fine Payment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="py-2 text-center">
<!--                                                <i class="fa fa-exclamation-circle fa-4x"></i>-->
                                                <h6 class="heading">Do you really want delete this record?</h6>
                                                </div>
                                            </div>
                                            <div class="modal-footer" id="delbtn">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>     
                                                                      
                                                                      
                                                                      
                                                                      
                                                                      
                                                                </td>                                   
                                                               
                                                            </tr>
                                                    <?php } ?>    
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

                            </div>
                        </div>
                    </div>
                </div>
<!--            </div>-->
            
    
    
   <?php
include "footer.php";


?>