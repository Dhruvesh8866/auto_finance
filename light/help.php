<?php
session_start();
if(!$_SESSION['username'])
	header('Location:login.php');

include "header.php";


?>
<script>
function change_status(val){    
	$.ajax({
		url:"check_account.php",
		type:"post",
		data:{val:val},
		success:function(result) {
			//alert(result);
            $('#showdata').html(result);
		}
	});
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
                            <div class="body">
                                <h4>Help</h4><hr>
                            

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