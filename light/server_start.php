<?php
include "header.php";
if($_SESSION['admin_right']['server_start']=='Y' && $_SESSION['user_view']=='Y'){ 
include "getpost-lib.php";


list($pending)=mysqli_fetch_array(mysqli_query($link,"select count(*) from sms WHERE status='N'"));
?>

<META HTTP-EQUIV=Refresh CONTENT='60; URL=server_start.php'>


<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5>SMS Setting</h5>
          </div>
           <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><span class="label label-success" style="font-size:16px; color:#06F">Remaining SMS : <?php echo $pending; ?></span></li>
        </ol>
      </div>
        </div>
      </div>
      <!-- /.container-fluid --> 
    </section>
<section class="content">
      <div class="card">
        <div class="card-body">     
     <?php
list($mask,$key,$url,$sms_limit)=mysqli_fetch_array(mysqli_query($link,"select mask,`key`,url,sms_limit from sms_setting where sms_id='1'"));
$result=mysqli_query($link,"select * from `sms` where status='N' LIMIT ".$sms_limit);
while($row=mysqli_fetch_array($result)) {

	$senderId=$mask;
$serverUrl=$url;
$authKey=$key;
$route="1";
$message =$row['sms'];
$mobile = $row['mobile'];

$json=sendsmsPOST($mobile,$senderId,$route,$message,$serverUrl,$authKey);

$yummy = json_decode($json);

$response=$yummy->response;
$responseCode=$yummy->responseCode;

				if($responseCode=="3001")
				{
					mysqli_query($link,"UPDATE `sms` SET `status`='Y',`senttime`=NOW(),track='".($response.'('.$responseCode.')')."' WHERE `id`='$row[id]'");
				}
	}
	

?>	
     

<div align="center"> <img src="<?php echo $path;?>images/server.gif" />           </div>
            
</div>
</div>
</section>   
<?php
    
    }
    else
    {
        echo '
        <div class="card-body">
        <div class="alert alert-danger" role="alert"> <strong>Enable!! </strong>
        <button class="close" data-dismiss="alert">×</button>
         You are not Authorized Person to access This Page !!.</div></div>';
        
    }
    ?>


<?php include "footer.php"; ?>