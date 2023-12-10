<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";


?>
   <script>
    //To print customers or download excel reports        
function print_payreport(type){
    var from =document.getElementById('from').value;
  var to =document.getElementById('to').value;
    window.open("payreport_print.php?type="+type+"&from="+from+"&to="+to, '_blank');
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
                                <h4>Payment List</h4><hr>
                              

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
                                

                            
                 <div class="mb-3"></div>               
                
                                            
                    <table class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline" id="example1">
                      <thead>
                        <tr>
                          <th>Sr No</th>
                          <th>Acc No </th>
                          <th>Name</th>
                          <th>Inst No.</th>
                          <th>Amount</th>
                          <th>Payment Type</th>
                          <th>Pay Date</th>
                          <th>EMI Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php                                         
                         //echo "select payment.acc_no,payment.inst_no,customer.name,payment.amount,payment.type,payment.pay_date,payment.emi_date FROM payment JOIN customer ON payment.acc_no=customer.acc_no where payment.pay_date BETWEEN '".$_GET['from']."' AND '".$_GET['to']."'";                               
						 $row="select payment.acc_no,payment.inst_no,customer.name,payment.amount,payment.type,payment.pay_date,payment.emi_date FROM payment JOIN customer ON payment.acc_no=customer.acc_no where payment.pay_date BETWEEN '".$_REQUEST['from']."' AND '".$_REQUEST['to']."'";    
                          
                        $result=mysqli_query($link,$row);
                                                        $i=0;
                                                        while( $show1=mysqli_fetch_array($result)) {                                                  
                                                        $i++
                                                        ?>
                                                           
                                                            <tr>
                                                                <td>
                                                               <?php echo $i; ?>                                                      
                                                                </td>
                                                                <td><?php echo $show1['acc_no']; ?></td>
                                                                <td><?php echo $show1['name']; ?></td>
                                                                <td><?php echo $show1['inst_no']; ?></td>
                                                                <td><?php echo $show1['amount']; ?></td>
                                                                <td><?php echo $show1['type']; ?></td>
                                                                <td><?php echo date('d-m-Y',strtotime($show1['pay_date'])); ?></td>
                                                                <td><?php echo date('d-m-Y',strtotime($show1['emi_date'])); ?></td>
                                
                                                                <td>
                                                                    <a class="btn btn-primary btn-sm"  href="payreceipt.php?pid=<?php echo $show1['inst_no']; ?>&accno=<?php echo $show1['acc_no']; ?>" target="_blank" ><i class="fa fa-print" aria-hidden="true"></i> </a>
<!--                                                                   <button class="btn btn-primary btn-icon-only"><i class="fa fa-print"></i></button>-->
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