<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";

$id=$_GET['id'];

$sql="select * from showroom where sh_id='$id'";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_array($result);
?>
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
                               <form class="forms-sample"  method="post" action="showroom_update_exe.php?id=<?php echo $id; ?>">
                                <h4>Update Showroom</h4><hr>
                                <div class="input-group mb-3"></div>
                               <div class="row">
                                     <div class="col-md-9">
                                 <label for="basic-url">Showroom Name</label>
                               
                                     <div class="input-group mb-3"> 
                                    <input type="text" class="form-control"  value="<?php echo $row['sh_name']; ?>" required name="shw_name" id="textfield" placeholder="Enter Showroom Name">
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-9">
                                <label for="basic-url">Showroom Address</label>
                                <div class="input-group mb-3">

                                    <textarea name="shw_address" required="required" id="textarea" placeholder="Enter Showroom address" class="form-control"> <?php echo $row['sh_address']; ?> </textarea>
                                </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-6">
                                <label for="basic-url">Showroom City</label>
                                <div class="input-group mb-3">

                                   <select name="shw_city" required="required" class="form-control" id="select">
                          <option values="Mehsana" <?php if($row['sh_city']=="Mehsana") echo 'selected'; ?>>Mehsana</option>
                          <option values="Ahemedabad" <?php if($row['sh_city']=="Ahemedabad") echo 'selected'; ?>>Ahemedabad</option>
                          <option values="Vadodra" <?php if($row['sh_city']=="Vadodra") echo 'selected'; ?>>Vadodra</option>
                      </select>
                                </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-9">
                                <label for="basic-url">Showroom Contact</label>
                                <div class="input-group mb-3">

                                    <input type="tel" value="<?php echo $row['sh_contact']; ?>" name="shw_contact" required="required" oninvalid="setCustomValidity('Please enter valid mobile no.')" pattern="[6789][0-9]{9}" placeholder="Enter Showroom contact" id="textfield3" class="form-control">
                                </div>  
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-9">
                                   <label for="basic-url">Showroom Pincode</label>
                                <div class="input-group mb-3">

                                    <input  type="number" name="shw_pincode" value="<?php echo $row['sh_pincode']; ?>" required="required" placeholder="eg. 384002" id="textfield4" class="form-control">
                                </div> 
                                      </div>
                                </div>
                                    
                                

                                <div class="btn-container">
                                        <button type="submit" class="btn btn-primary ">
                                                <span class="btn-inner--icon"><i class="fa fa-refresh"></i></span> Update
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