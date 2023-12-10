<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";

$sql="select * from admin";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_array($result);

?>
<script>

    function check_phone(){
    document.getElementById('b_contact').style.border="";
    var phone=document.getElementById('b_contact').value;
    var mob=phone.trim();
    var length=mob.length;
    if(isNaN(mob)){
        document.getElementById('b_contact').style.border="solid 1px red";
        document.getElementById('sh_phone').innerHTML="Please enter valid Phone number";
    }
    else{
        document.getElementById('sh_phone').innerHTML="";
        if(length!=10 && mob!=""){
            document.getElementById('b_contact').style.border="solid 1px red";
            document.getElementById('sh_phone').innerHTML="Please enter valid Phone number";
        }else{
            document.getElementById('sh_phone').innerHTML="";

        }
    }
    
}
function check_pincode(){
    document.getElementById('b_pincode').style.border="";
    var pin=document.getElementById('b_pincode').value;
    var pincode=pin.trim();
    var length=pin.length;
    if(isNaN(pincode)){
        document.getElementById('b_pincode').style.border="solid 1px red";
        document.getElementById('sh_pin').innerHTML="Please enter valid pincode number";
    }
    else{
        document.getElementById('sh_pin').innerHTML="";
        if(length!=6 && pincode!=""){
                        document.getElementById('b_pincode').style.border="solid 1px red";
                        document.getElementById('sh_pin').innerHTML="Please enter valid pincode number";
        }else{
            document.getElementById('sh_pin').innerHTML="";

        }
    }
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
                                <form class="forms-sample"  method="post" action="admin_edit_exe.php" enctype="multipart/form-data">
                                <h4>Edit Profile</h4><hr>
                                <div class="input-group mb-3"></div>
                                
                               <div class="row">
                                    <div class="col-md-6" align="center">
<!--                                    <div class="profile-image"> <img src="../assets/images/user.png" class="rounded-circle" alt=""> </div>-->
                                <div class="profile-image"><img src="upload/<?php echo $row['logo']; ?>" class="rounded-circle" width="150" height="175" /></div>
                                
                                <div class="m-t-15 m-b-30">
<!--                                    <button class="btn btn-primary" >Edit</button>-->
                                  <input type="file" id="selectedFile" name="photo" style="display:none" />
                                  <input type="button" value="Edit" onclick="document.getElementById('selectedFile').click();" class="btn btn-primary" />
                                    <button class="btn btn-outline-secondary">Delete</button>
                                </div>
                                   </div>
                                     <div class="col-md-6">
                                     <label for="basic-url">Business Name</label>
                               
                                     <div class="input-group mb-3"> 
                                    <input type="text" class="form-control" name="b_name" id="b_name" value="<?php echo $row['business_name']; ?>" placeholder="Enter Business Name" required>
                                    </div>
                                    
                                    <label for="basic-url">Business Address</label>
                                     <div class="input-group mb-3"> 
                                     <textarea name="b_address" id="b_address" rows="3" placeholder="Enter Business address" class="form-control" required><?php echo $row['business_address']; ?> </textarea>
                                         </div>
                                    
                                    </div>
                                </div>

                                <div class="row">
                                     <div class="col-md-6">
                                     <label for="basic-url">Business Contact</label>
                               
                                     <div class="mb-3"> 
                                     <input type="tel" class="form-control" name="b_contact" id="b_contact" value="<?php echo $row['business_contact']; ?>" placeholder="Enter Business contact" onblur="check_phone();" pattern="[0-9]{10}" title="Enter 10 digit valid mobile number" maxlength="10" required>
                                         <span id="sh_phone" style="color:red;"></span>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="basic-url">Branch</label>
                               
                                     <div class="input-group mb-3"> 
                                    <input type="text" class="form-control" name="branch" id="branch" value="<?php echo $row['branch']; ?>" placeholder="Enter Branch Name" required>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-6">
                                     <label for="basic-url">Pincode</label>
                               
                                     <div class="mb-3"> 
                                    <input type="tel" class="form-control" name="b_pincode" id="b_pincode" value="<?php echo $row['pincode']; ?>" placeholder="Enter Pincode" onblur="check_pincode();" maxlength="6" pattern="[0-9]{6}" title="Enter 6 Digit pincode" required>
                                         <span id="sh_pin" style="color:red;"></span>
                                    </div>
                                    </div>
                                    
                                </div>
                               <h5>Payment Details</h5><hr>
                                <div class="row">
                                     <div class="col-md-9">
                                     <label for="basic-url">Paytm id</label>
                               
                                     <div class="input-group mb-3"> 
                                    <input type="text" class="form-control" name="m_id" id="m_id" value="<?php echo $row['m_id']; ?>" placeholder="Enter Paytm id" required>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-9">
                                     <label for="basic-url">Paytm Key</label>
                               
                                     <div class="input-group mb-3"> 
                                    <input type="text" class="form-control" name="m_key" id="m_key" value="<?php echo $row['m_key']; ?>" placeholder="Enter Paytm Key" required>
                                    </div>
                                    </div>
                                </div>
                                <h5>Beneficiary Details</h5><hr>
                                <div class="row">
                                     <div class="col-md-6">
                                     <label for="basic-url">Benif Name</label>
                               
                                     <div class="input-group mb-3"> 
                                    <input type="text" class="form-control" name="benif_name" id="benif_name" value="<?php echo $row['benif_name']; ?>" placeholder="Enter Benif Name" required>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-6">
                                     <label for="basic-url">Benif Account</label>
                               
                                     <div class="input-group mb-3"> 
                                    <input type="text" class="form-control" name="benif_acc" id="benif_acc" value="<?php echo $row['benif_acc']; ?>" placeholder="Enter Benif account no" pattern="[0-9]{5,}" title="Enter valid Bank account number" required>
                                    </div>
                                    </div>
                                </div>    
                                <div class="row">
                                     <div class="col-md-6">
                                     <label for="basic-url">Benif IFSC</label>
                               
                                     <div class="input-group mb-3"> 
                                    <input type="text" class="form-control" name="benif_ifsc" id="benif_ifsc" value="<?php echo $row['benif_ifsc']; ?>" placeholder="Enter Benif IFSC" pattern="[A-Za-z]{4}0[A-Za-z0-9]{6}" title="Enter valid IFSC code" required>
                                    </div>
                                    </div>
                                </div>
<!--
                                <div class="row">
                                    <div class="col-md-6">
                                    <button type="submit" class="btn btn-gradient-info btn-fw-2">Submit</button>
                                    <button class="btn btn-light" onclick="history.back()">Back</button>
                                    </div>
                                </div>
-->
                                <div class="btn-container">
                                        <button type="submit" class="btn btn-primary ">
                                                <span class="btn-inner--icon"><i class="fa fa-file-text"></i></span> Save
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="history.back()">
                                                <span class="btn-inner--icon"><i class="fa fa-arrow-left"></i></span> Back
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
    
   <?php
include "footer.php";


?>