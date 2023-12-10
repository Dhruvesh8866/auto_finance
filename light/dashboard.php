<?php

session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";

//
$sql="SELECT acc_no FROM customer";
$sql1="SELECT sh_id FROM showroom";
$result=mysqli_query($link,$sql);
$result1=mysqli_query($link,$sql1);  
$rowcount=mysqli_num_rows($result);
$rowcount1=mysqli_num_rows($result1);

$paytotal=mysqli_fetch_array(mysqli_query($link,"SELECT SUM(amount) FROM payment where pay_date=CURDATE()")); 
$showpaytotal=mysqli_fetch_array(mysqli_query($link,"SELECT SUM(amount) FROM showroom_payment where pay_date=CURDATE()")); 
$colle=mysqli_fetch_array(mysqli_query($link,"SELECT SUM(customer.emi) FROM customer JOIN cust_inst_record ON customer.acc_no=cust_inst_record.acc_no where cust_inst_record.inst_date=CURDATE()")); 
                 
?>
    
                         
                    
       
<link rel="stylesheet" href="../assets/vendor/charts-c3/plugin.css" />
       
<script src="../assets/bundles/libscripts.bundle.js"></script>

<script src="../assets/bundles/c3.bundle.js"></script>
<!-- Theme JS -->
<script src="../assets/js/pages/charts/c3.js"></script>

<script>
    //SELECT SUM(customer.loan_amount),MONTHNAME(payment.pay_date)='March' FROM customer JOIN payment ON customer.acc_no=payment.acc_no
//SELECT MONTHNAME(pay_date) FROM payment;
    //SELECT SUM(customer.loan_amount) FROM customer JOIN payment ON customer.acc_no=payment.acc_no WHERE MONTHNAME(payment.pay_date)='March';

   $(document).ready(function(){
            var chart = c3.generate({
                bindto: '#chart-barr', // id of chart wrapper
                data: {
                    columns: [
                        // each columns data
                        ['data1',
                        <?php
                        $inc_data=array();
                        $inc_now=date('01-m-Y');
                        
                            for($i=12;$i>=1;$i--)
                            {
                                $inc_ndate=date("Y-m", strtotime("-".$i." months ". $inc_now));
                                
                                list($inc_data1)=mysqli_fetch_array(mysqli_query($link,"SELECT SUM(amount) FROM payment WHERE DATE_FORMAT(pay_date,'%Y-%m')='$inc_ndate'"));
                                if($inc_data1=='') $inc_data1=0;
                                array_push($inc_data,$inc_data1);
                                
                            } 
                            echo implode(',',$inc_data);
                        
                         ?>
                        
                        
                        ],
                        ['data2',
                         
                         <?php
                        $data=array();
                        $now=date('01-m-Y');
                        
                            for($i=12;$i>=1;$i--)
                            {
                                $ndate=date("Y-m", strtotime("-".$i." months ". $now));
                                
                                list($data1)=mysqli_fetch_array(mysqli_query($link,"SELECT SUM(loan_amount) FROM customer WHERE DATE_FORMAT(loan_date,'%Y-%m')='$ndate'"));
                                if($data1=='') $data1=0;
                                array_push($data,$data1);
                                
                            } 
                            echo implode(',',$data);
                        
                         ?>
                         
                         
                         
                         ]
                    ],
                    type: 'bar', // default type of chart
                    colors: {
                        'data1': bigbucket.colors["blue"],
                        'data2': bigbucket.colors["cyan"]
                    },
                    names: {
                        
                        'data1': 'Inwards',
                        'data2': 'Outwards'
                    }
                },
                axis: {
                    x: {
                        type: 'category',
                        // name of each category
                        <?php 
                        $month=array();
                        $now=date('01-m-Y');
                        
                            for($i=12;$i>=1;$i--)
                            {
                                array_push($month,date("M-Y", strtotime("-".$i." months ". $now)));
                            } 
                            
                        $month=implode("','",$month); 
                                     ?>
                        categories: [<?php echo "'".$month."'"; ?>]
                    },
                },
                bar: {
                    width: 16
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

<script>
      $(document).ready(function(){
            var chart = c3.generate({
                bindto: '#chart-piee', // id of chart wrapper
                data: {
                    columns: [
                        // each columns data
                        ['data1',
                        <?php $loan_completed="SELECT acc_no FROM customer where loan_clear='Yes'"; 
                         $result4=mysqli_query($link,$loan_completed);
                         $rowcount3=mysqli_num_rows($result4);
                         echo $rowcount3;
                         ?>
                        
                        ],
                        ['data2', <?php $loan_live="SELECT acc_no FROM customer where loan_clear='No'"; 
                         $result5=mysqli_query($link,$loan_live);
                         $rowcount4=mysqli_num_rows($result5);
                         echo $rowcount4;
                         ?>]
                       
                    ],
                    type: 'pie', // default type of chart
                    colors: {
                        'data1': bigbucket.colors["blue-darker"],
                        'data2': bigbucket.colors["blue"],
                        'data3': bigbucket.colors["blue-light"],
                        'data4': bigbucket.colors["blue-lighter"]
                    },
                    names: {
                        // name of each serie
                        'data1': 'Completed Loan',
                        'data2': 'Pending Loan'
                       
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
        
    <div class="main_content" id="main-content">
        <div class="page">

            <div class="container-fluid">

               <h4>Dashboard</h4><hr>
                <div class="row clearfix">
                   
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card state_w1">
                            <div class="body d-flex justify-content-between">
                                <div>
                                    <h5><?php echo $rowcount; ?></h5>
                                    <span> Customers</span>
                                </div>
                                <span class="sparkbar-small" style="color:#6574CD;"><i class="fa fa-users fa-3x"  style="display: inline-block; width: 41px; height: 47px; vertical-align: top;"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card state_w1">
                            <div class="body d-flex justify-content-between">
                                <div>                                
                                    <h5><?php 
                                        if($paytotal[0]=='')
                                            echo '00.00';
                                        else                                        
                                            echo $paytotal[0]; ?></h5>
                                    <span> Day's Collection</span>
                                </div>
                                <span class="sparkbar-small" style="color:#6574CD;"><i class="fa fa-rupee fa-3x" style="display: inline-block; width: 47px; height: 47px; vertical-align: top;"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card state_w1">
                            <div class="body d-flex justify-content-between">
                                <div>
                                    <h5><?php echo $rowcount1;  ?></h5>
                                    <span>Showroom</span>
                                </div>
                                <span class="sparkbar-small" style="color:#6574CD;"><i class="fa fa-home fa-3x"  style="display: inline-block; width: 47px; height: 47px; vertical-align: top;"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card state_w1">
                            <div class="body d-flex justify-content-between">
                                <div>                            
                                    <h5><?php 
                                        if($showpaytotal[0]=='')
                                            echo '00.00';
                                        else
                                            echo $showpaytotal[0]; ?></h5>
                                    <span>Today's Show. Pay</span>
                                </div>
                                <span class="sparkbar-small" style="color:#6574CD;"><i class="fa fa-bank fa-3x" style="display: inline-block; width: 47px; height: 47px; vertical-align: top;"></i></span>
                            </div>
                        </div>
                    </div>
                </div>             
<!--            </div>-->
            
             <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                              <div class="card planned_task">
                                                          <div class="body">
                                                          <h4>Graphical Status (Income & Expence)</h4><hr>                          
                            
                                                            <div id="chart-barr" style="height: 16rem"></div>
                                                                                      
                                                  </div>
                                        </div>
                 </div>
            </div>
            
        <div class="row clearfix">
         <div class="container-fluid">
          <div class="row">
          <div class="col-md-6">
            <div class="card">                               
                    <div class="header">
                        <h2>Today's Customer Payment</h2>
                        <div class="card-tools">
                        <?php if($paytotal[0]!=""){ ?>
                         <span class="badge badge-success float-right">
                            <?php  
                            echo $paytotal[0]; ?>
                         </span>
                         <?php } ?>
                        </div>
                     </div>        
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                           No 
                                                        </th>
                                                        <th>Customer Name</th>                                    
                                                        <th>Receipt No</th>                                    
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                    <?php                                         
                                                        
//                                                        $show1=mysqli_fetch_array(mysqli_query($link,"SELECT showroom.sh_name, showroom_payment.amount FROM showroom JOIN showroom_payment ON showroom.sh_id=showroom_payment.sh_id where pay_date=CURDATE()"));    
                                                       // $result=mysqli_query($link,$sql);
                                                        
                                                        
                                                        $sqlcpay="SELECT payment.acc_no,payment.p_id,payment.inst_no, payment.amount,payment.type,customer.name FROM payment JOIN customer ON payment.acc_no=customer.acc_no where payment.pay_date=CURDATE()";
                                                        $resultcpay=mysqli_query($link,$sqlcpay);          
                                                        $i=0;
                                                        while( $show2=mysqli_fetch_array($resultcpay)) {
                                                        
                                                        $i++
                                                        ?>
                                                           
                                                            <tr>
                                                        <td><?php echo $i; ?>                                                      
                                                                </td>
                                                                <td>
                                                                  <?php echo $show2['name']; ?>
                                                                </td>
                                                                <td>
                                                                   <?php 
                                                                    $account= $show2['acc_no'];
                                                                    $install = $show2['inst_no'];
                                                                    if ($show2['type']=='Online')
                                                                    {
                                                                        list($orderid)=mysqli_fetch_array(mysqli_query($link,"select `orderid` from temp WHERE `acc_no`=$account and `inst_no`=$install and `status`='Success'"));
                                                                        echo $orderid;
                                                                    }
                                                                    else{
                                                                    echo $show2['p_id'];
                                                                    } ?>
                                                                </td>  
                                                                <td>
                                                                   <?php echo $show2['amount']; ?>
                                                                </td>                                 
                                                               
                                                            </tr>
                                                    <?php } ?> 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>                                           
            </div>    
          </div>
          

                 <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2>Customer Graphical View</h2>
                            </div>
                            <div class="body">
                                <div id="chart-piee" style="height: 16rem"></div>
                            </div>
                        </div>
                    </div>
                            </div>
</div>
                </div>
           
                     <div class="row clearfix">
              <div class="container-fluid">

            <div class="row">
            
              
            <div class="col-md-6">
            <div class="card">                               
                    <div class="header">
                        <h2>Today's Collection Reminder</h2>
                        <div class="card-tools">
                        <?php if($colle[0]!=""){ ?>
                         <span class="badge badge-success float-right">
                            <?php  
                            echo $colle[0]; ?>
                         </span>
                         <?php } ?>
                        </div>
                     </div>        
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                           No 
                                                        </th>
                                                        <th>Customer Name</th>                                    
                                                        <th>Account No</th>                                    
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                    <?php                                                                        
                                                        $sqlcoll="SELECT customer.name, customer.acc_no,customer.emi FROM customer JOIN cust_inst_record ON customer.acc_no=cust_inst_record.acc_no where cust_inst_record.inst_date=CURDATE()";
                                                        $resultcoll=mysqli_query($link,$sqlcoll);
                                                        $i=0;
                                                        while( $show5=mysqli_fetch_array($resultcoll)) {
                                                        
                                                        $i++
                                                        ?>
                                                           
                                                            <tr>
                                                        <td><?php echo $i; ?>                                                      
                                                                </td>
                                                                <td>
                                                                  <?php echo $show5['name']; ?>
                                                                </td>
                                                                <td>
                                                                   <?php echo $show5['acc_no']; ?>
                                                                </td>  
                                                                <td>
                                                                   <?php echo $show5['emi']; ?>
                                                                </td>                                 
                                                               
                                                            </tr>
                                                    <?php } ?> 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>                                           
            </div>    
          </div>            
            <div class="col-md-6">
            <div class="card">                               
                        <div class="header">
                            <h2>Today's Sowroom Payment Details</h2>
                            <div class="card-tools">
                            <?php if($showpaytotal[0]!=""){ ?>
                            <span class="badge badge-success float-right">
                             <?php 
                                echo $showpaytotal[0];  
                             ?>
                            </span>
                            <?php } ?>
                            </div>
                        </div>
                                    
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0 c_list">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                           No 
                                                        </th>
                                                        <th>Showroom</th>                                    
                                                        <th>Amount</th>                                    
                                                        
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                    <?php                                                                     
                                                        $sqlpay="SELECT showroom.sh_name, showroom_payment.amount,showroom.sh_id FROM showroom JOIN showroom_payment ON showroom.sh_id=showroom_payment.sh_id where showroom_payment.pay_date=CURDATE()";
                                                        $resultpay=mysqli_query($link,$sqlpay);
                                                        $i=0;
                                                        while( $show1=mysqli_fetch_array($resultpay)) {
                                                        
                                                        $i++
                                                        ?>                                                           
                                                            <tr>
                                                                <td>
                                                               <?php echo $i; ?>                                                      
                                                                </td>
                                                                <td>
                                                                  <?php echo $show1['sh_name']; ?>
                                                                </td>
                                                                <td>
                                                                   <?php echo $show1['amount']; ?>
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
          
                                      
           <div class="row">
           
             <div class="col-md-6">
            <div class="card">                               
                                    <div class="header">
                                        <h2>Due Customer List : 1 Day</h2>
                                  
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0 c_list">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                           # 
                                                        </th>
                                                        <th>Customer Name</th>                                    
                                                        <th>Account No</th>                                    
                                                        <th>Amount</th>   
                                                        
                                                    </tr>
                                                </thead>
                                                   
                                                    <?php                                                                        
                                                        $due="select customer.name, customer.acc_no,customer.emi FROM customer JOIN cust_inst_record ON customer.acc_no=cust_inst_record.acc_no where inst_date = curdate() - INTERVAL 1 DAY";
                                                        $resultdue=mysqli_query($link,$due);
                                                        $i=0;
                                                        while( $show6=mysqli_fetch_array($resultdue)) {
                                                        
                                                        $i++
                                                        ?>
                                                           
                                                            <tr>
                                                        <td><?php echo $i; ?>                                                      
                                                                </td>
                                                                <td>
                                                                  <?php echo $show6['name']; ?>
                                                                </td>
                                                                <td>
                                                                   <?php echo $show6['acc_no']; ?>
                                                                </td>  
                                                                <td>
                                                                   <?php echo $show6['emi']; ?>
                                                                </td>                                 
                                                               
                                                            </tr>
                                                    <?php } ?>                                                   
                                            </table>
                                        </div>
                                    </div>
                                           
            </div>    
          </div>
            
            
            
           <div class="col-md-6">
            <div class="card">                               
                                    <div class="header">
                                        <h2>Total Loan Given</h2>
                                  
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0 c_list">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                           No 
                                                        </th>
                                                        <th>Name</th>                                    
                                                        <th>Amount</th>                                    
                                                        
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                    <?php                                                                                    
                                                        $show=mysqli_fetch_array(mysqli_query($link,"SELECT SUM(loan_amount) FROM customer"));   ?>                                                           
                                                            <tr>
                                                                <td>1                                                        
                                                                </td>
                                                                <td>
                                                                  Total Loan Amount
                                                                </td>
                                                                <td>
                                                                   <?php echo $show[0]; ?>
                                                                </td>                                                              
                                                            </tr>                                             
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                           
            </div>    
          </div>
          
          
        </div>
           
        <div class="row">
         <div class="col-md-6">
            <div class="card">                               
                    <div class="header">
                        <h2>Upcoming Collections</h2>                       
                     </div>        
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                           A/c No 
                                                        </th>
                                                        <th>SMS</th>                                    
                                                        <th>Whatsapp</th>                                    
                                                        
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                    <?php                                                                        
                                                        $upcoll="SELECT customer.name,customer.acc_no,cust_inst_record.inst_no,cust_inst_record.emi,DATE_FORMAT(cust_inst_record.inst_date, '%d-%m-%Y') AS inst_date from customer JOIN cust_inst_record ON customer.acc_no=cust_inst_record.acc_no WHERE  cust_inst_record.inst_date >= curdate() AND cust_inst_record.inst_date < curdate() + INTERVAL 1 MONTH";
                                                        $resultupcoll=mysqli_query($link,$upcoll);                                  
                                                        while( $show8=mysqli_fetch_array($resultupcoll)) {                           
                                                        ?>                                                           
                                                            <tr>
                                                        <td><?php echo $show8['acc_no']; ?>                                                      
                                                                </td>
                                                                <td style="font-size:12px;" align="justify">
                                                                  Dear, <b><?php echo $show8['name']; ?></b> Your EMI No <b><?php echo $show8['inst_no']; ?></b> with rupees <b><?php echo $show8['emi']; ?></b> has been due on <strong class="badge badge-danger"><?php echo $show8['inst_date']; ?></strong>. Please pay as soon as possible. Thanks
                                                                </td>
                                                                <td align="center">
                                                                   <button class="btn btn-success btn-sm" type="button"><i class="fa  fa-whatsapp"></i></button>
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
    
</div>
   <?php
include "footer.php";
?>