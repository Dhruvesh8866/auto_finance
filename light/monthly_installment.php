<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";

$search=$_REQUEST['cur_date'];

?>

<script>

function print_month_details(val){
    //alert(val);
    var cur_date=document.getElementById('cur_date').value;
    if(cur_date==""){
        alert("Please select any month");
    }    
    else{    
    //alert(acc);
    window.open("print_month_details.php?type="+val+"&cur_date="+cur_date, '_blank');
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
                
              <form class="forms-sample" method="post">
                <h4>Monthly Installment</h4>
                <hr>
                  
                 

                <button type="button" class="btn btn-warning btn-sm" onclick="print_month_details('P');"><i class="fa fa-print"></i> Print</button>

                <button type="button" class="btn btn-slack btn-sm" onclick="print_month_details('E');"><i class="fa fa-file-excel-o"></i> Excel</button>
                                
                  <div class="input-group mb-3"> </div> 
                  
                <div class="row">
                  <div class="col-md-6"> <b>
                    <label for="basic-url">Month</label>
                    </b>
                    <div class="input-group" id="adv-search">
                      <select name="cur_date" id="cur_date" class="form-control" required>
                        <option value="">Select Month</option>
                        <?php 
                          $now=date('01-m-Y'); 
                          for($i=6;$i>=-6;$i--){
                              $date=date('m-Y', strtotime($now. '-'.$i. 'months'));
                          ?>  
                        <option value="<?php echo $date; ?>" <?php if($date==$_REQUEST['cur_date']) echo 'selected'; ?>   ><?php echo $date; ?> </option>
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
                
              <table class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline" id="example1">
                      <thead>
                        <tr>
                          <th>Acc No </th>
                          <th>Name</th>
                          <th>Contact</th>
                          <th>Inst No.</th>
                          <th>EMI Date</th>
                          <th>Status</th>
                          <th>EMI amount</th>    
                        </tr>
                      </thead>
                      <tbody>
                        <?php                                         
                            //$inst_res="SELECT `acc_no`, `inst_no`, `inst_date`, `inst_clear`, `emi` FROM `cust_inst_record` WHERE DATE_FORMAT(inst_date,'%m-%Y')='$search'";
                          $inst_res="SELECT cir.acc_no, cir.inst_no, cir.inst_date, cir.inst_clear, cir.emi, c.name, c.mob_no FROM cust_inst_record cir JOIN customer c ON cir.acc_no=c.acc_no WHERE DATE_FORMAT(cir.inst_date,'%m-%Y')='$search'";
                            $inst_result=mysqli_query($link,$inst_res);
                          while($row=mysqli_fetch_array($inst_result)){  ?>
                              <tr>
                                        <td><?php echo $row['acc_no']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['mob_no']; ?></td>
                                        <td><?php echo $row['inst_no']; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($row['inst_date'])); ?></td>
                                        <td><?php echo $row['inst_clear']; ?></td>
                                        <td><?php echo $row['emi']; ?></td>
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