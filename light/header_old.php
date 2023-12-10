<?php
include "connect.php";

//$arrCurUrl = explode("/",$_SERVER['PHP_SELF']);
//$curUrl = $arrCurUrl[count($arrCurUrl)-1];

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
<!--    <link rel="stylesheet" href="../assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">-->
    <link rel="stylesheet" href="../assets/css/main.css" type="text/css">
    
      <!-- DataTables -->
      <link rel="stylesheet" href="datatable/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="datatable/responsive.bootstrap4.min.css">
</head>
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
    
<body class="theme-indigo">
    <!-- Page Loader -->
<!--
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="assets/images/brand/icon_black.svg" width="48" height="48" alt="ArrOw"></div>
            <p>Please wait...</p>
        </div>
    </div>
-->

    <nav class="navbar custom-navbar navbar-expand-lg py-2">
        <div class="container-fluid px-0">
            <a href="javascript:void(0);" class="menu_toggle"><i class="fa fa-align-left"></i></a>
            <a href="dashboard.php" class="navbar-brand"><img src="../assets/images/brand/icon.svg" alt="BigBucket" />
                <strong>Auto</strong> Fin</a>
            <div id="navbar_main">
                <ul class="navbar-nav mr-auto hidden-xs">
                    <li class="nav-item page-header">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">Stater Page</li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-icon" href="javascript:void(0);" id="navbar_1_dropdown_3" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fa fa-list"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <h6 class="dropdown-header">User menu</h6>
                            <a class="dropdown-item" href="admin_edit.php"><i class="fa fa-user text-primary"></i>My Profile</a>
                            <a class="dropdown-item" href="customer_payment.php"><i
                                    class="fa fa-briefcase text-primary"></i>Customer Payment</a>

                            <div class="dropdown-divider" role="presentation"></div>
                              <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out text-primary"></i>Sign
                                out</a>
                        </div>
                    </li>
                </ul>
            </div>
<!--
        <div id="navbar_main">
                <ul class="navbar-nav mr-auto hidden-xs">
                    <li class="nav-item page-header">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">Stater Page</li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-icon" href="javascript:void(0);" id="navbar_1_dropdown_2" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fa fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xl py-0">
                            <div class="py-3 px-3">
                                <h5 class="heading h6 mb-0">Notifications <span
                                        class="badge badge-pill badge-primary text-uppercase float-right">3</span></h5>
                            </div>
                            <div class="list-group">
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex">
                                    <div class="list-group-img"><span class="avatar bg-purple">JD</span></div>
                                    <div class="list-group-content">
                                        <div class="list-group-heading">Johnyy Depp <small>10:05 PM</small></div>
                                        <p class="text-sm">Lorem ipsum dolor consectetur adipiscing eiusmod tempor</p>
                                    </div>
                                </a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex">
                                    <div class="list-group-img"><span class="avatar bg-pink">TC</span></div>
                                    <div class="list-group-content">
                                        <div class="list-group-heading">Tom Cruise <small>10:05 PM</small></div>
                                        <p class="text-sm">Lorem ipsum dolor sit amet consectetur eiusmod tempor</p>
                                    </div>
                                </a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex">
                                    <div class="list-group-img"><span class="avatar bg-blue">WS</span></div>
                                    <div class="list-group-content">
                                        <div class="list-group-heading">Will Smith <small>10:05 PM</small></div>
                                        <p class="text-sm">Lorem sit amet consectetur adipiscing eiusmod tempor</p>
                                    </div>
                                </a>
                            </div>
                            <div class="py-3 text-center">
                                <a href="javascript:void(0);" class="link link-sm link--style-3">View all notifications</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-icon" href="javascript:void(0);" id="navbar_1_dropdown_3" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fa fa-list"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <h6 class="dropdown-header">User menu</h6>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-user text-primary"></i>My Profile</a>
                            <a class="dropdown-item" href="javascript:void(0);"><span
                                    class="float-right badge badge-success">$50K</span><i
                                    class="fa fa-briefcase text-primary"></i>My Balance</a>

                            <div class="dropdown-divider" role="presentation"></div>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-sign-out text-primary"></i>Sign
                                out</a>
                        </div>
                    </li>
                </ul>
            </div>
-->
        </div>
            <div class="left_sidebar">
            <nav class="sidebar">

                <ul id="main-menu" class="metismenu">
<!--                    <li class="g_heading">Main</li>-->
                    <li><a href="dashboard.php"><i class="ti-home"></i><span>Dashboard</span></a></li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow"><i class="ti-pencil-alt"></i><span>Add info</span></a>
                        <ul>
                            <li><a href="customers.php">Customer</a></li>
                        <li><a href="showrooms.php">Showroom</a></li>
                        <li><a href="withhold.php">Withhold Vehicle</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow"><i class="ti-wallet"></i><span>Payment</span></a>
                        <ul>
                            <li><a href="customer_payment.php">Customer Payment</a></li>
                            <li><a href="Payment_report.php">Payment Report</a></li>
                            <li><a href="showroom_payment.php">Showroom Payment</a></li>
                            <li><a href="receipt.php">Reprint Receipt</a></li>
                            <li><a href="fine_payment.php">Fine Payment</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow"><i class="ti-files"></i><span>Reports</span></a>
                        <ul>
                            <li><a href="inst_rem.php">Installment remaining</a></li>
                            <li><a href="monthly_installment.php">Monthly Installment</a></li>
                            <li><a href="loan_complete.php">Loan Complete</a></li>
                            <li><a href="fine_payment_report.php">Fine Payment Report</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow"><i class="ti-comment-alt"></i><span>SMS Setting</span></a>
                        <ul>
                            <li><a href="message.php">SMS</a></li>
                            <li><a href="pending_sms.php">Pending</a></li>
                            <li><a href="history_sms.php">History</a></li>
                            <li><a href="#">Server Start</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow"><i class="ti-settings"></i><span>Setting</span></a>
                        <ul>
                            <li><a class="dropdown-item" href="change_password.php">Change Password</a></li>
                            <li><a class="dropdown-item" href="admin_edit.php">Edit Profile</a></li>
                        </ul>
                    </li>
                    <li><a href="inquiries.php"><i class="ti-help-alt"></i><span>Inquiries</span></a></li>
                    <li><a href="logout.php"><i class="ti-power-off"></i><span>Log Out</span></a></li>
                    
                </ul>
            </nav>
        </div>
    </nav>
    