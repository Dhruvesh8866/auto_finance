<?php
include "connect.php";
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

?>
<select name="customer" id="customer" class="form-control" onchange="customerdetails(this.value);" required>
                                        <option value="">Select Customer</option>
                                        <?php 
    

                                          $sql1="SELECT `c_id`,`acc_no`,`name` FROM `customer` WHERE `showroom`='".$_GET['sid']."'";

                                          $result1=mysqli_query($link,$sql1);
                                           while($row=mysqli_fetch_array($result1)) {
                                        ?>
                                          <option value="<?php echo $row['acc_no']; ?>"><?php echo '['.$row['acc_no'].'] '; echo $row['name']; ?></option> 
                                        <?php } ?>  
                                    </select>