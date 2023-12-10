<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";


?>
<script>
function check_phone(){
    document.getElementById('shw_contact').style.border="";
    var phone=document.getElementById('shw_contact').value;
    var mob=phone.trim();
    var length=mob.length;
    if(isNaN(mob)){
        document.getElementById('shw_contact').style.border="solid 1px red";
        document.getElementById('sh_phone').innerHTML="Please enter valid Phone number";
    }
    else{
        document.getElementById('sh_phone').innerHTML="";
        if(length!=10 && mob!=""){
            document.getElementById('shw_contact').style.border="solid 1px red";
            document.getElementById('sh_phone').innerHTML="Please enter valid Phone number";
        }else{
            document.getElementById('sh_phone').innerHTML="";

        }
    }
    
}
function check_pincode(){
    document.getElementById('shw_pincode').style.border="";
    var pin=document.getElementById('shw_pincode').value;
    var pincode=pin.trim();
    var length=pin.length;
    if(isNaN(pincode)){
        document.getElementById('shw_pincode').style.border="solid 1px red";
        document.getElementById('sh_pin').innerHTML="Enter valid pincode number";
    }
    else{
        document.getElementById('sh_pin').innerHTML="";
        if(length!=6 && pincode!=""){
                        document.getElementById('shw_pincode').style.border="solid 1px red";
                        document.getElementById('sh_pin').innerHTML="Enter valid pincode number";
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
-->                         <?php if(isset($_SESSION['success']) && $_SESSION['success']==true){ ?>
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
                               <form class="forms-sample" method="post" action="showroom_insert.php">
                                <h4>Add Showroom</h4><hr>
                                <div class="input-group mb-3"></div>
                               <div class="row">
                                     <div class="col-md-9">
                                        <label for="basic-url">Showroom Name</label>
                               
                                     <div class="input-group mb-3"> 
                                    <input type="text" class="form-control" required name="shw_name" id="textfield" placeholder="Enter Showroom Name">
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-9">
                                <label for="basic-url">Showroom Address</label>
                                <div class="input-group mb-3">

                                    <textarea name="shw_address" required="required" id="textarea"  placeholder="Enter Showroom address" class="form-control"></textarea>
                                </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-6">
                                <label for="basic-url">Showroom City</label>
                                <div class="input-group mb-3">

                                   <select name="shw_city" required="required" class="form-control" id="select">
                                        <option values="">--Select City--</option>
                                        <option values="Palanpur">Palanpur</option>
                                        <option values="Mehsana">Mehsana</option>
                                        <option values="Ahemedabad">Ahemedabad</option>
                                   </select>
                                </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-9">
                                <label for="basic-url">Showroom Contact</label>
                                <div class="mb-3">
                                    <input type="tel" name="shw_contact" pattern="[0-9]{10}" placeholder="Enter Showroom contact" id="shw_contact" class="form-control" title="Enter 10 digit valid mobile number" onblur="check_phone();" maxlength="10" required>
                                    <span id="sh_phone" style="color:red;"></span>
                                </div>  
                                    </div>
                                </div>
                                  <div class="row">
                                     <div class="col-md-9">
                                   <label for="basic-url">Showroom Pincode</label>
                                <div class="mb-3">

                                    <input type="tel" pattern="[0-9]{6}" name="shw_pincode" placeholder="eg. 384002" id="shw_pincode" class="form-control" maxlength="6" title="Enter 6 Digit pincode" required onkeyup="check_pincode();" autocomplete="off">
                                    <span id="sh_pin" style="color:red;"></span>

                                </div> 
                                      </div>
                                </div>
                                    
                                

<!--
                                <div class="row">
                                <div class="col-md-2">

                                    <button type="submit" class="btn btn-block btn-secondary">Submit</button>
                                    </div>
                                    <div class="col-md-2">

                                    <button type="button" class="btn btn-block btn-secondary" onclick="history.back()">Back</button>
                                    </div>
                                </div> 
-->
                                   <div class="btn-container">
                                        <button type="submit" class="btn btn-primary ">
                                                <span class="btn-inner--icon"><i class="fa fa-file-text"></i></span> Submit
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="window.location.href='showrooms.php'">
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