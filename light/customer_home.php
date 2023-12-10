<?php
include "connect.php";
session_start();
if(!$_SESSION['accno'])
	header('Location:customer_login.php');

$accno=$_SESSION['accno'];

include "connect.php";


list($check_loan,$check_hold)=mysqli_fetch_array(mysqli_query($link,"SELECT `loan_clear`,`wh_back` FROM `customer` WHERE `acc_no`=$accno"));
if($check_loan=="Yes"){
    $_SESSION['success']="<b>Loan Clear!</b><br>Loan amount is paid by this customer";
}

if($check_hold=="Yes"){
    $_SESSION['fail']="<b>Withhold Vehicle!</b> <br>This customer's vehicle is taken back";
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="ThemeMakker">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Auto Finance</title>

    <link rel="stylesheet" href="../assets/vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/main.css" type="text/css">      
    <script src="../assets/bundles/libscripts.bundle.js"></script>    
    <script src="../assets/bundles/vendorscripts.bundle.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/vendor/LightboxGallery/mauGallery.min.js"></script>
<script src="../assets/vendor/LightboxGallery/scripts.js"></script>
<script>
         
         $(document).ready(function(){
            var chart = c3.generate({
                bindto: '#chart-donutt', // id of chart wrapper
                data: {
                    columns: [
                        // each columns data
                        ['data1',  
                         <?php 
                         $loan_rem=mysqli_fetch_array(mysqli_query($link,"SELECT SUM(emi) FROM cust_inst_record where inst_clear='No' and acc_no=$accno"));  
                         if($loan_rem[0]=='')
                         {
                             echo 0;
                         }
                         else{
                             echo $loan_rem[0]; 
                         }                                                 
                         ?>                                                                                                   
                        ],
                        ['data2',
                         <?php 
                         $loan_com=mysqli_fetch_array(mysqli_query($link,"SELECT SUM(emi) FROM cust_inst_record where inst_clear='Yes' and acc_no=$accno"));  
                         if($loan_com[0]=='')
                         {
                             echo 0;
                         }
                         else{
                             echo $loan_com[0]; 
                         }                                                 
                         ?>                        
                        ]
                    ],
                    type: 'donut', // default type of chart
                    colors: {
                        'data1': bigbucket.colors["blue"],
                        'data2': bigbucket.colors["cyan"]
                    },
                    names: {
                        // name of each serie
                        'data1': 'Remaining',
                        'data2': 'Paid'
                    }
                },
                axis: {
                },
                legend: {
                    show: true, //hide legend
                },
                padding: {
                    bottom: 0,
                    top: 0
                },
            });
        });


</script>
</head>

<!--graphs-->
<link rel="stylesheet" href="../assets/vendor/charts-c3/plugin.css" />       
<script src="../assets/bundles/libscripts.bundle.js"></script>
<script src="../assets/bundles/c3.bundle.js"></script>
<script src="../assets/js/pages/charts/c3.js"></script>
 
  <body class="theme-indigo">    
    <nav class="navbar custom-navbar navbar-expand-lg py-2">
        <div class="container-fluid px-0">           
            <a href="javascript:void(0);" class="menu_toggle"><i class="fa fa-align-left"></i></a>
            <a href="customer_home.php" class="navbar-brand"><img src="../assets/images/brand/icon.svg" alt="BigBucket" />
                <strong>Auto</strong> Fin</a>
            <div id="navbar_main">
                <ul class="navbar-nav mr-auto hidden-xs">                     
                    <li class="nav-item page-header">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="customer_home.php"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">Home Page</li>
                        </ul>
                    </li>
                </ul>                
               <a href="customer_details.php"> 
                  <li class="nav-item dropdown mr-4 " style="color:white;">
                   Details       
                  </li>
               </a>
                <li class="nav-item dropdown ">

                    <a href="customer_logout.php">  <i class="fa fa-power-off" style="color:white;"></i></a>
                                        
                </li>
            </div>
        </div>
      
    </nav>
        <div class="main_content" id="main-content">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task mt-3">
                          
                           <div class="col-md-12">
                           <h3>Welcome! <?php                             
                            $resul=mysqli_fetch_array(mysqli_query($link,"select `acc_no`,`name`,`fine` from customer where acc_no=$accno"));
                            echo $resul['name'];
                               ?></h3><hr>
                            </div>
                            <div class="input-group mb-1"></div>
                            <div class="row">
                            <div class="col-md-6 ">
                               <?php 
                                $result2=mysqli_fetch_array(mysqli_query($link,"select `acc_no`,`name`,`address`,`mob_no` from customer where acc_no=$accno"));
                                ?>

                                <div class="col-12">
                                <strong >Account No : </strong><small><?php echo $result2['acc_no']; ?></small>
                                </div>

                                <div class="col-12">
                                <strong >Customer Name : </strong><small><?php echo $result2['name']; ?></small>     
                                </div>

                                <div class="col-12">
                                <strong >Address : </strong><small><?php echo $result2['address']; ?></small>
                                </div>

                                <div class="col-12">
                                <strong>Contact : </strong><small><?php echo $result2['mob_no']; 
                                     ?></small>
                                </div>
                                <div class="col-12">
                                <strong>Late Fine Charge : </strong><small><?php echo $resul['fine']; 
                                     ?></small>
                                </div>

                                </div>
                                </div>
                              
                            <div class="input-group mb-3"></div> 
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
                                     
                <div class="col-md-12">
                            <div class="card">
                              <div class="card-header p-1" style="background-color:#3a639b">
                                <ul class="nav nav-pills">

                                  <li class="nav-item"><a class="nav-link text-white btn-sm mt-1 pb-1 pt-1 active" href="#timeline" data-toggle="tab">Pay </a></li>
                                  <li class="nav-item"><a class="nav-link text-white btn-sm mt-1 pb-1 pt-1" href="#activity" data-toggle="tab">Paid </a></li>
                                   <li class="nav-item"><a class="nav-link text-white btn-sm mt-1 pb-1 pt-1" href="#fine" data-toggle="tab">Fine </a></li>

                                </ul>
                              </div>                
                              <div class="card-body">
                                <div class="tab-content">
                                  <div class="tab-pane" id="activity">
                                   <div class="card-body table-responsive p-0 ta" style="height: 300px;">

                                <table class="table table-head-fixed  table-hover table-sm">
                                  <thead>
                                    <tr>
                                       <th>Sr No</th>
                                      <th>Emi Date</th>
                                      <th>Emi</th>
                                      <th>Date</th>
                                      <th>Pay Amount </th>
                                      <th>Print</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php 
                                   $sqlcpay="SELECT payment.emi_date,payment.amount,payment.pay_date,customer.emi FROM payment JOIN customer ON customer.acc_no=payment.acc_no where payment.acc_no=$accno";
                                                                        $resultpay=mysqli_query($link,$sqlcpay);
                                                                        $i=0; 
                                                                        $totalemi=0;$totalamount=0;
                                                                        while( $show2=mysqli_fetch_array($resultpay)) {                           
                                                                        $i++                                                                      
                                  ?>
                                   <tr>

                                      <td><?php echo $i;  ?></td>
                                      <td><?php echo date('d-m-Y',strtotime($show2['emi_date'])); ?></td>
                                      <td><?php echo $show2['emi'];  $totalemi=$totalemi + $show2['emi'];  ?></td>
                                      <td><?php echo $show2['pay_date']; ?></td>
                                      <td><?php echo $show2['amount']; $totalamount=$totalamount + $show2['amount']; ?> </td>
                                      <td><a class="btn btn-sm btn-primary"  href="payreceipt.php?pid=<?php echo $i; ?>&accno=<?php echo $accno; ?>" target="_blank" ><i class="fa fa-print" aria-hidden="true"></i> </a></td>
                                    </tr>                                                                                
                         <?php } ?>
                                 </tbody>
                                  <tfoot>

                            <tr style="background-color:#ccc;">
                              <td><strong>Total</strong></td>
                              <td></td>
                              <td colspan="2"><strong><?php echo $totalemi; ?></strong></td>              
                              <td colspan="2"><strong><?php echo $totalamount; ?></strong></td>

                            </tr>
                          </tfoot>
                        </table>
                              </div>
                                  </div>

                                  <div class="tab-pane active" id="timeline">
                                    <div class="card-body table-responsive p-0" style="height: 280px;">
                                <table class="table table-hover table-sm">


                                  <thead>
                                    <tr>
                                       <th>EMI No</th>
                                      <th>EMI Date</th>
                                      <th>EMI Amount </th>
                                      <th>Pay</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                   <?php 
                                      $row=mysqli_fetch_array(mysqli_query($link,"select * from customer WHERE acc_no=$accno")); 
                                      $totalrememi=0;
                                      for($j=$i;$j<$row['loan_month'];$j++){
                                      $date1=date('d-m-Y',strtotime('+'.$j.' Month '.$row['first_emi_date']));
                                      $date2=date('Y-m-d',strtotime($date1));
                                       list($clear,$emi)=mysqli_fetch_array(mysqli_query($link,"select `inst_clear`,emi from `cust_inst_record` WHERE `acc_no`=$accno and `inst_no`='".($j+1)."' and `inst_date`='$date2'"));

                                      ?>
                                    <tr>
                                        <td><?php echo $j+1;?></td>
                                        <td><?php echo $date1; ?></td>
                                        <td><?php echo $row['emi']; $totalrememi=$totalrememi + $row['emi']; ?></td>                        
                                        <td>
                                            <?php  	
                                          $no =($j+1);
                                        list($last_inst,$instno)=mysqli_fetch_array(mysqli_query($link,"SELECT `inst_clear`,inst_no FROM `payment` WHERE `acc_no`=$accno order by `inst_no` DESC"));
                                        if($instno == "") $instno = 1; else $instno = $instno + 1;  
                                              if($instno == $no){?>

                                              <a class="btn btn-sm btn-success" href="upi_pay/index.php?acc_no=<?php echo $row['acc_no']; ?>&inst=<?php echo $j+1; ?>&date=<?php echo date('Y-m-d',strtotime($date1)); ?>">Pay</a>

                                              <?php } 

                                            ?>                         
                                        </td>


                                    </tr>                             
                                  </tbody>
                                  <?php }?> 
                                  <tfoot>



                            <tr style="background-color:#ccc;">
                              <td colspan="2"><strong>Total</strong></td>
                              <td ><strong><?php echo $totalrememi; ?></strong></td>
                              <td></td>


                            </tr>
                          </tfoot>
                                </table>
                              </div>

                                  </div>  
                                  
                                     <div class="tab-pane" id="fine">
                                    <div class="card-body table-responsive p-0" style="height: 280px;">
                                <table class="table table-hover table-sm">


                                    <thead>
            <tr>
              <th>No</th>
              <th>Emi Date</th>
              <th>Emi</th>
              <th>Pay Date</th>
              <th>Pay Amount </th>
                            <th>Due Day </th>
            </tr>
          </thead>
          <tbody>
                       <?php                                         
                                                        
						$row3=mysqli_fetch_array(mysqli_query($link,"select * from customer WHERE acc_no=$accno"));    
						$y=0;
						$due_day=0;
						$total=0;
						for($k=$y;$k<$row3['loan_month'];$k++){
														
						 $date1=date('d-m-Y',strtotime('+'.$k.' Month '.$row3['first_emi_date']));
                         $date2=date('Y-m-d',strtotime($date1));
                            
						 list($pid,$pay_amount,$paydate,$instnum,$capital,$inst)=mysqli_fetch_array(mysqli_query($link,"select p_id,sum(amount),pay_date,inst_no,emi_capital,emi_interest from payment where acc_no=$accno and inst_no='".($k+1)."'"));
						 
						 list($clear,$emi)=mysqli_fetch_array(mysqli_query($link,"select `inst_clear`,emi from `cust_inst_record` WHERE `acc_no`=$accno and `inst_no`='".($k+1)."' and `inst_date`='$date2'"));
                            
                        
				            
						?>
                        <tr>
              <td><?php echo $k+1;?></td>
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
                                <tfoot>

                            <tr style="background-color:#ccc;">                              
                              <td colspan="6" align="center"><strong>Total Fine : <?php echo $due_day; ?> * <?php $fine_charge =$resul['fine']; echo $fine_charge; ?> = <?php echo $due_day * $fine_charge; ?> </strong></td>                                            

                            </tr>
                          </tfoot>                             
                                </table>
                              </div>

                                  </div>                                                                                                                     
                                </div>                                
                              </div>
                            </div>                            
                            </div>     
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12" align="center">
            <div class="card">
                <div class="header">
                    <h2>Loan Amount (Pending & Paid)</h2>
                </div>
                <div class="body">
                    <div id="chart-donutt" style="height: 18rem"></div>
                </div>
            </div>
        </div>
      </div>
    </body>
</html>