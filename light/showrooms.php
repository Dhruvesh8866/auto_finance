<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header_old.php";


?>
<script>
    
//To print showrooms or download excel reports    
    
function print_showrooms(type){
    //alert(type);
    window.open("showroom_print.php?type="+type, '_blank');
}
</script>

        <div class="main_content" id="main-content">



        <div class="page">

            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task">

                            <!-- To print showroom update message -->
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
                            <h4>Showroom Details</h4>
                              <hr>
                             <a href="add_showroom.php"> <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Showroom</button></a>
                             
                            <button type="button" class="btn btn-warning btn-sm" onclick="print_showrooms('P');"><i class="fa fa-print"></i> Print</button>

                            <button type="button" class="btn btn-slack btn-sm" onclick="print_showrooms('E');"><i class="fa fa-file-excel-o"></i> Excel</button>
                              
                            <div class="input-group mb-3"></div>
                               <table class="table table-bordered table-striped table-hover" id="example1">
                                         <thead>
                                <tr>
                                <th> Showroom name </th>
                                <th> Address </th>
                                <th> City </th>
                                <th> Contact </th>
                                <th> Pincode </th>
                                <th> Action</th>    
                                </tr>
                          </thead>
                                    <tbody>
                                                   <?php
                            if($search!='')
                          {
                              $sql="select * from showroom WHERE sh_name LIKE '$search%' or sh_address LIKE '$search%'";
                          }
                          else
                          {
                            $sql="select * from showroom";
                          }
                          //$sql="select * from showroom";
                          $result=mysqli_query($link,$sql);
                          while($row=mysqli_fetch_array($result)) {
                          ?>
                          <tr>
                            <td><?php echo $row['sh_name']; ?></td>
                            <td><?php echo $row['sh_address']; ?></td>
                            <td><?php echo $row['sh_city']; ?></td>
                            <td><?php echo $row['sh_contact']; ?></td>
                            <td><?php echo $row['sh_pincode']; ?></td>
                            <td><a href="delete_showroom.php?id=<?php echo $row['sh_id']; ?>">
                                  <button type="button" class="btn btn-danger btn-icon-only rounded-circle">
                                     <span class="btn-inner--icon"><i class="fa fa-trash-o"></i></span>
                                   </button>
                                </a> 
                                            
                            <a href="showroom_update.php?id=<?php echo $row['sh_id']; ?>">
                                   <button type="button" class="btn btn-primary btn-icon-only rounded-circle">
                                        <span class="btn-inner--icon"><i class="fa fa-edit"></i></span>
                                    </button>
                            </a>
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