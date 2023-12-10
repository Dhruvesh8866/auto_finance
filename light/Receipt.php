<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";


?>
   <script>
    //To print customers or download excel reports        
function print_payreport(type){
    //alert(type);
   
    var from =document.getElementById('from').value;
  var to =document.getElementById('to').value;
    var acc_no =document.getElementById('acc_no').value;
    window.open("receiptreport_print.php?type="+type+"&from="+from+"&to="+to+"&acc_no="+acc_no, '_blank');
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
                           
                            <div class="body">
                                
                            
                                <form class="forms-sample" method="POST">
                                <h4>Receipt Print</h4><hr>
                              

                                <button type="button" class="btn btn-warning btn-sm" onclick="print_payreport('P');"><i class="fa fa-print"></i> Print</button>

                                <button type="button" class="btn btn-slack btn-sm" onclick="print_payreport('E');"><i class="fa fa-file-excel-o"></i> Excel</button>
                                                                                                
                              
                                <div class="mb-3"></div>                                
                                <div class="input-group mb-3"></div>

          <div class="row">
<div class="col-md-3">
              <label for="text1">From </label>
              <div class="mb-3">
                <input class="form-control form-control-sm" required  name="from" id="from" type="date" value="<?php echo $_REQUEST['from']; ?>">
              </div>
            </div> 
<div class="col-md-3">
              <label for="text1" class="control-label"> To</label>
              <div class="mb-3">
               <input class="form-control form-control-sm" required name="to" id="to" type="date" value="<?php echo date('Y-m-d'); ?>" >
              </div>
            </div> 
            
<div class="col-md-3">
              <label for="text1" class="control-label">Account No.</label>
              <div class="mb-3">
              <input type="text" class="form-control form-control-sm" required id="acc_no" value="<?php echo $_REQUEST['acc_no']; ?>" name="acc_no" autocomplete="off" placeholder="Enter Account No">
              </div>
            </div>
            
            
<div class="col-md-3">
              <label for="text1" class="control-label">&nbsp;</label>
              <div class="mb-3">
                <button type="submit" class="btn btn-facebook btn-sm"><i class="fa fa-search"></i> Search</button>
                                      
              </div>
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
                         <th>Pay Date</th>
                         <th>EMI no.</th>
                         <th>Amount</th>
                         <th>Print</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php                                         
                         //echo "select payment.acc_no,payment.inst_no,customer.name,payment.amount,payment.type,payment.pay_date,payment.emi_date FROM payment JOIN customer ON payment.acc_no=customer.acc_no where payment.pay_date BETWEEN '".$_GET['from']."' AND '".$_GET['to']."'";                               
						 $row="select payment.acc_no,customer.name,payment.amount,payment.pay_date,payment.inst_no FROM payment JOIN customer ON payment.acc_no=customer.acc_no where payment.pay_date BETWEEN '".$_REQUEST['from']."' AND '".$_REQUEST['to']."' and payment.acc_no='".$_REQUEST['acc_no']."'";    
                          
                        $result=mysqli_query($link,$row);
                                                        $i=0;
                                                        while( $show1=mysqli_fetch_array($result)) {                                                  
                                                        $i++
                                                        ?>
                                                           
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo $show1['acc_no']; ?></td>
                                                                <td><?php echo $show1['name']; ?></td>
                                                                <td><?php echo date('d-m-Y',strtotime($show1['pay_date'])); ?> </td>
                                                                <td><?php echo $show1['inst_no']; ?></td>
                                                                <td><?php echo $show1['amount']; ?></td>
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
            
   <?php
include "footer.php";


?>