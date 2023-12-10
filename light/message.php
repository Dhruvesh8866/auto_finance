<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";

$sql="select * from pre_sms";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_array($result);

	$_SESSION['msg']='[NAME] Customer Name <br>[FILE] Account Number <br>[AMT] Installment Amount <br>[INST] Installment Number <br>[DATE] Installment Date';


?>
<script>
    
    

</script>

        <div class="main_content" id="main-content">



        <div class="page">

            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task">

                            <!-- To print message -->
                            <?php if(isset($_SESSION['msg']) && $_SESSION['msg']==true){ ?>
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['msg'];?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                            <?php } unset($_SESSION['msg']); ?>
                            
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
                            <div class="table-responsive">
                            <h4>Messages</h4>
                              <hr>
                             
                            <div class="input-group mb-3"></div>
                                <form class="form-sample" action="sms_setting_update.php" method="post" enctype="multipart/form-data">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td width="12%">Welcome SMS</td>
                                            <td>
                                                <textarea name="wel_sms" id="wel_sms" rows="2" class="form-control" required readonly><?php echo $row['wel_sms']; ?></textarea>
                                            </td>
                                            <td width="15%">
                                            <div class="custom-control custom-radio inline-cr">
                                                <input type="radio" name="type1" class="custom-control-input" id="no1" value="No" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="type" <?php if($row['wel_sent']=='No') echo checked; ?>>
                                                <label class="custom-control-label" for="no1">No</label>
                                            </div>
                                            <div class="custom-control custom-radio inline-cr">
                                                <input type="radio" name="type1" class="custom-control-input" id="yes1" value="Yes" data-parsley-multiple="type" <?php if($row['wel_sent']=='Yes') echo checked; ?>>
                                                <label class="custom-control-label" for="yes1" >Yes</label>
                                            </div>
                                            <p id="error-radio"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Due SMS</td>
                                            <td>
                                                <textarea name="due_sms" id="due_sms" rows="2" class="form-control" required readonly><?php echo $row['due_sms']; ?></textarea>
                                            </td>
                                            <td>
                                            <div class="custom-control custom-radio inline-cr">
                                                <input type="radio" name="type2" class="custom-control-input" id="no2" value="No" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="type" <?php if($row['due_sent']=='No') echo checked; ?>>
                                                <label class="custom-control-label" for="no2">No</label>
                                            </div>
                                            <div class="custom-control custom-radio inline-cr">
                                                <input type="radio" name="type2" class="custom-control-input" id="yes2" value="Yes" data-parsley-multiple="type" <?php if($row['due_sent']=='Yes') echo checked; ?>>
                                                <label class="custom-control-label" for="yes2" >Yes</label>
                                            </div>
                                            <p id="error-radio"></p>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Reminder SMS</td>
                                            <td>
                                                <textarea name="rem_sms" id="rem_sms" rows="2" class="form-control" required readonly><?php echo $row['reminder_sms']; ?></textarea>
                                            </td>
                                            <td>
                                            <div class="custom-control custom-radio inline-cr">
                                                <input type="radio" name="type3" class="custom-control-input" id="no3" value="No" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="type" <?php if($row['reminder_sent']=='No') echo checked; ?>>
                                                <label class="custom-control-label" for="no3">No</label>
                                            </div>
                                            <div class="custom-control custom-radio inline-cr">
                                                <input type="radio" name="type3" class="custom-control-input" id="yes3" value="Yes" data-parsley-multiple="type" <?php if($row['reminder_sent']=='Yes') echo checked; ?>>
                                                <label class="custom-control-label" for="yes3" >Yes</label>
                                            </div>
                                            <p id="error-radio"></p>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Payment SMS</td>
                                            <td>
                                                <textarea name="payment_sms" id="payment_sms" rows="2" class="form-control" required readonly><?php echo $row['pay_sms']; ?></textarea>
                                            </td>
                                            <td>
                                            <div class="custom-control custom-radio inline-cr">
                                                <input type="radio" name="type4" class="custom-control-input" id="no4" value="No" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="type" <?php if($row['pay_sent']=='No') echo checked; ?>>
                                                <label class="custom-control-label" for="no4">No</label>
                                            </div>
                                            <div class="custom-control custom-radio inline-cr">
                                                <input type="radio" name="type4" class="custom-control-input" id="yes4" value="Yes" data-parsley-multiple="type" <?php if($row['pay_sent']=='Yes') echo checked; ?>>
                                                <label class="custom-control-label" for="yes4" >Yes</label>
                                            </div>
                                            <p id="error-radio"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fine SMS</td>
                                            <td>
                                                <textarea name="fine_sms" id="fine_sms" rows="2" class="form-control" required readonly> <?php echo $row['fine_sms']; ?></textarea>
                                            </td>
                                            <td>
                                            <div class="custom-control custom-radio inline-cr">
                                                <input type="radio" name="type5" class="custom-control-input" id="no5" value="No" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="type" <?php if($row['fine_sent']=='No') echo checked; ?>>
                                                <label class="custom-control-label" for="no5">No</label>
                                            </div>
                                            <div class="custom-control custom-radio inline-cr">
                                                <input type="radio" name="type5" class="custom-control-input" id="yes5" value="Yes" data-parsley-multiple="type" <?php if($row['fine_sent']=='Yes') echo checked; ?>>
                                                <label class="custom-control-label" for="yes5" >Yes</label>
                                            </div>
                                            <p id="error-radio"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Birthday SMS</td>
                                            <td>
                                                <textarea name="bday_sms" id="bday_sms" rows="2" class="form-control" required readonly><?php echo $row['birth_sms']; ?></textarea>
                                            </td>
                                            <td>
                                            <div class="custom-control custom-radio inline-cr">
                                                <input type="radio" name="type6" class="custom-control-input" id="no6" value="No" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="type" <?php if($row['birth_sent']=='No') echo checked; ?>>
                                                <label class="custom-control-label" for="no6">No</label>
                                            </div>
                                            <div class="custom-control custom-radio inline-cr">
                                                <input type="radio" name="type6" class="custom-control-input" id="yes6" value="Yes" data-parsley-multiple="type" <?php if($row['birth_sent']=='Yes') echo checked; ?>>
                                                <label class="custom-control-label" for="yes6" >Yes</label>
                                            </div>
                                            <p id="error-radio"></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                    
                                    <div class="btn-container">
                                                <button type="submit" class="btn btn-primary ">
                                                        <span class="btn-inner--icon"><i class="fa fa-file-text"></i></span> Save
                                                </button>
                                                <button type="button" class="btn btn-danger">
                                                        <span class="btn-inner--icon"><i class="fa fa-refresh"></i></span> Reset
                                                </button>

                                    </div>
                                    
                                </form>
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