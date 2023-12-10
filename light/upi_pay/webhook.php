<?php
$link=mysqli_connect('localhost','rajendra_user','user@7890','rajendra_website');
date_default_timezone_set('Asia/Kolkata');
$path="//".$_SERVER['HTTP_HOST']."/";

$datetime=date('Y-m-d H:i:s');
$str=json_encode($_REQUEST,TRUE);
$data=json_decode($str,TRUE);
mysqli_query($link,"INSERT INTO `notification_data`( `noti`, `created`) VALUES ('$str','$datetime')");
// Merchant secret key

$secret_key = "2fc4d2a2bb54be07adbd474d33053921";

// Data received from gateway
$order_id = $_POST['order_id'];
$amount = $_POST['amount'];
$status = $_POST['status'];
$post_hash = $_POST['post_hash'];

// Compute the payment hash locally
$local_hash = md5($order_id.$amount.$status.$secret_key);

if ($post_hash == $local_hash) {
  // Mark the transaction as success & process the order
  $hash_status = "Hash Matched";
  $pay_status = "Order ID : $order_id <br> Amount : $amount <br> Status : $status <br> Hash Status : $hash_status";
}

else {
  // Suspicious payment, dont process this payment.
  $hash_status = "Hash Mismatch";
  $pay_status = "Order ID : $order_id <br> Amount : $amount <br> Status : $status <br> Hash Status : $hash_status";
}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>UPI Gateway Response</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="https://upi.infomattic.com/images/favicon.png" type="image/gif">

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600&display=swap" rel="stylesheet">

      <style>
            body{
                font-family: 'Nunito Sans', sans-serif;
                background-color: #F2F3F4;
            }

          .well{
              background-color: #fff;
              border-color: #F2F3F4;
          }
      </style>

   </head>
   <body>
      <div class="container">
         <br><br>
         <h3 class="text-center">UPI Gateway Response</h3>
         <br><br>
         <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
               <div class="well">
                  <?php echo $pay_status; ?>
               </div>
            </div>
            <div class="col-sm-4">
            </div>
         </div>
      </div>
   </body>
</html>
