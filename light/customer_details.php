<?php

session_start();
if(!$_SESSION['accno'])
	header('Location:customer_login.php');

$accno=$_SESSION['accno'];

include "connect.php";

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
    <link rel="stylesheet" href="../assets/vendor/morrisjs/morris.css">
    <link rel="stylesheet" href="../assets/css/main.css" type="text/css">
    
<!--
<style>
        .vertical {
            border-left: 6px solid black;
            height: 150px;
            position:absolute;
            left: 50%;
        }
    </style>
-->         
<script src="../assets/bundles/libscripts.bundle.js"></script>    
<script src="../assets/bundles/vendorscripts.bundle.js"></script>

<script src="../assets/bundles/morrisscripts.bundle.js"></script> <!-- Morris Plugin Js --> 

<script src="../assets/js/theme.js"></script>
<script src="../assets/js/pages/charts/morris.js"></script>
</head>

<!--
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
   -webkit-appearance: none;
   margin: 0;
}
input[type="number"] {
   -moz-appearance: textfield;
}
</style>
-->
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
                            <li class="breadcrumb-item active">User Details</li>
                                 
                                  
                        </ul>
                    </li>
                </ul>
                
               <a href="customer_details.php"> <li class="nav-item dropdown mr-4 " style="color:white;">
                   Details       </li></a>
                <li class="nav-item dropdown ">

                   <i class="fa fa-power-off" style="color:white;"></i>                     
                                        
                </li>
            </div>
        </div>
      
    </nav>
        <div class="main_content" id="main-content">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task mt-3">
                          
                          <div class="header" >
                      <h3>Profile</h3>
                            
                        <?php 
                            //$accno=$_SESSION['accno'];
                            $resul=mysqli_fetch_array(mysqli_query($link,"select `acc_no`,`name`,`mob_no`,`address`,`city`,`pincode`,`loan_amount`,`loan_month`,`loan_rate`,`file_charge`,`gtr_name`,`gtr_address`,`gtr_contact`,`gtr_document`,`vehicle_reg_no`,`chassis_no`,`engine_no`,`model`,`vehicle_amount`,`downpayment`,DATE_FORMAT(birthday, '%M %d, %Y') AS birthday,DATE_FORMAT(loan_date, '%M %d, %Y') AS loan_date from customer where acc_no=$accno"));
                            
                               ?>
                                                        
                            </div>
                            
                            <div class="body">
                               <div class="row">
                               <div class="col-md-2">
                                <div class="profile-image"> <img src="../assets/images/user8.jpg" alt="">  </div>                                
                                </div>
<!--                                <div class = "vertical"></div>-->
                                <div class="col-md-10">                                
                                <div class="row">
                                <div class="col-md-5">
                                  <h3><?php echo $resul['name']; ?></h3>
                                  <p class="mb-0 text-muted">Date of Birth: <?php echo $resul['birthday']; ?> </p>
                                   </div>
                                   <div class="col-md-5">
                                   <div><i class="ti ti-mobile"></i> <strong >Phone : </strong> <font class="mb-0 text-muted"><?php echo $resul['mob_no']; ?></font><br></div>
                                   <div class="mt-3"><i class="ti ti-location-pin"></i> <strong >Address : </strong> <font class="mb-0 text-muted"><?php echo $resul['address']; ?></font><br></div>
                                   <div class="mt-3"><i class="ti ti-home"></i> <strong >City : </strong> <font class="mb-0 text-muted"><?php echo $resul['city']; ?></font><br></div>
                                   <div class="mt-3"><i class="ti ti-notepad"></i> <strong >Pincode : </strong> <font class="mb-0 text-muted"><?php echo $resul['pincode']; ?></font><br></div>                                                                     
                                    </div>
                                   </div>
                                   </div>                                
                                </div>                                                                                      
                            </div>                                                                       
                    </div>
                </div>
            </div>
        </div> 
        
        <div class="container-fluid">

            <div class="row">                          
                <div class="col-md-6">
                <div class="card">                               
                        <div class="header">
                        <h3>Loan Details</h3>                    
                         </div>
                        <div class="body">                      
                         <div><i class="ti ti-wallet"></i> <strong >Loan Amount : </strong> <font class="mb-0 text-muted"><?php echo $resul['loan_amount']; ?></font><br></div>    
                         <div class="mt-3"><i class="ti ti-time"></i> <strong >Total Loan Months : </strong> <font class="mb-0 text-muted"><?php echo $resul['loan_month']; ?></font><br></div>         
                         <div class="mt-3"><i class="ti ti-plus"></i> <strong >Loan Interest : </strong> <font class="mb-0 text-muted"><?php echo $resul['loan_rate']; ?> %</font><br></div>                                     
                         <div class="mt-3"><i class="ti ti-file"></i> <strong >Loan File Charge : </strong> <font class="mb-0 text-muted"><?php echo $resul['file_charge']; ?></font><br></div>
                          <div class="mt-3"><i class="ti ti-calendar"></i> <strong >Loan Date : </strong> <font class="mb-0 text-muted"><?php echo $resul['loan_date']; ?></font><br></div>          
                        </div>                                           
                </div>    
              </div>            
                <div class="col-md-6">
                <div class="card">                               
                            <div class="header">
                            <h3>Guarantor Details</h3>
                            </div>                                    
                            <div class="body">
                            <div><i class="ti ti-user"></i> <strong >Guarantor Name : </strong> <font class="mb-0 text-muted"><?php echo $resul['gtr_name']; ?></font><br></div> 
                            <div class="mt-3"><i class="ti ti-location-pin"></i> <strong >Guarantor Address : </strong> <font class="mb-0 text-muted"><?php echo $resul['gtr_address']; ?></font><br></div> 
                            <div class="mt-3"><i class="ti ti-mobile"></i> <strong >Guarantor Contact : </strong> <font class="mb-0 text-muted"><?php echo $resul['gtr_contact']; ?></font><br></div> 
                            <div class="mt-3"><i class="ti ti-files"></i> <strong >Guarantor Document : </strong> <a href="upload/<?php echo $resul['gtr_document']; ?>" class="btn btn-sm btn-success" target="_blank"><?php echo $resul['gtr_document']; ?></a><br></div> 
                            <div class="mt-3"> &nbsp;</div> 
                            </div>                
                </div>    
              </div>                    
          </div>
        </div>
                         
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                   <div class="card">                               
                        <div class="header">
                        <h3>Vehicle Details</h3>
                        </div> 
                        <div class="body">
                            <div><i class="ti ti-car"></i> <strong >Vehicle No : </strong> <font class="mb-0 text-muted"><?php echo $resul['vehicle_reg_no']; ?></font><br></div>
                            <div class="mt-3"><i class="ti ti-write"></i> <strong >Chassis No : </strong> <font class="mb-0 text-muted"><?php echo $resul['chassis_no']; ?></font><br></div>
                            <div class="mt-3"><i class="ti ti-receipt"></i> <strong >Engine No : </strong> <font class="mb-0 text-muted"><?php echo $resul['engine_no']; ?></font><br></div>
                            <div class="mt-3"><i class="ti ti-agenda"></i> <strong >Model : </strong> <font class="mb-0 text-muted"><?php echo $resul['model']; ?></font><br></div>
                            <div class="mt-3"><i class="ti ti-wallet"></i> <strong >Vehicle Amount : </strong> <font class="mb-0 text-muted"><?php echo $resul['vehicle_amount']; ?></font><br></div>
                            <div class="mt-3"><i class="ti ti-book"></i> <strong >Down Payment : </strong> <font class="mb-0 text-muted"><?php echo $resul['downpayment']; ?></font><br></div>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>                
      </div>                  
    </body>
</html>
   
