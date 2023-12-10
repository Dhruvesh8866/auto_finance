<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";
?>

<script>
// To check old password is same or not    
function check_pass(val){    
	$.ajax({
		url:"check_old_password.php",
		type:"post",
		data:{val:val},
		success:function(result) {
			//alert(result);
            if(result=='1'){
                
                document.getElementById("showdata").innerHTML="Old Password is correct";
                document.getElementById("showdata").style="color:green;";
               //$('#showdata').html(result);
            }else{
               // document.getElementById("o_pass").value="";
                var o_pass= document.getElementById("o_pass").value;
                if(o_pass==""){
                    document.getElementById("showdata").innerHTML="";
                }
                else{
                document.getElementById("showdata").innerHTML=" Old Password is Wrong";
                document.getElementById("showdata").style="color:red;";    
                }
            }           
            
		}
	});
}

// To check new password and confirm password are same    
function match_pass(){
    document.getElementById('n_pass').style.border="";
    document.getElementById('c_pass').style.border="";
    var n_pass=document.getElementById('n_pass').value;
    var c_pass=document.getElementById('c_pass').value;
    if(n_pass!="" && c_pass!=""){
        if(n_pass!=c_pass){
            document.getElementById('n_pass').style.border="solid 1px red";
            document.getElementById('c_pass').style.border="solid 1px red";
            document.getElementById('sdata').innerHTML="new password and confirm password are not same";
        }
        else{
            document.getElementById('n_pass').style.border="solid 1px green";
            document.getElementById('c_pass').style.border="solid 1px green";
            document.getElementById('sdata').innerHTML="";
        }
    }
    else{
            document.getElementById('sdata').innerHTML="";
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
                             <form class="form-sample" action="change_password_exe.php" method="post">
                                <h4>Change Password</h4><hr>
                                <div class="row">
                                     <div class="col-md-9">
                                        <label for="basic-url"><b>Old Password</b></label> 
                                         <div class="mb-3"> 
                                            <input type="password" class="form-control" name="o_pass" id="o_pass" placeholder="Enter old Password" onblur = "check_pass(this.value);" required autocomplete="off">
                                             <span id="showdata"></span>
                                         </div>
                                         
                                    </div>    
                                </div>                                         
                                <div class="row">
                                     <div class="col-md-9">
                                        <label for="basic-url"><b>New Password</b></label>
                                         <div class="input-group mb-3"> 
                                            <input type="text" class="form-control" name="n_pass" id="n_pass" placeholder="Enter old Password" onkeyup="match_pass();" required autocomplete="off">
                                         </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-9">
                                        <label for="basic-url"><b>Confirm Password</b></label>
                                         <div class="mb-3"> 
                                            <input type="password" class="form-control" name="c_pass" id="c_pass" placeholder="Enter old Password" onkeyup="match_pass();" required autocomplete="off">
                                            <span id="sdata"></span> 
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
                                                <span class="btn-inner--icon"><i class="fa fa-key"></i></span> Save
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