<?php
include"../connect.php";
############# Define the collection UPI type #############

 $upi_id_type = "merchant";      // Set this if your upi id type is merchant

// $upi_id_type = "non_merchant";  // Set this if your upi id type is non merchant


############# Define the appropriate api url #############


if($upi_id_type == "merchant"){

 // Defining the URL to hit to initiate the payment
 $url = "https://upi.infomattic.com/pay.php";
 $checkout_type = "Merchant";

}
elseif($upi_id_type == "non_merchant"){

 // Defining the URL to hit to initiate the payment
 $url = "https://upi.infomattic.com/checkout.php";
 $checkout_type = "Non Merchant";
}
else
{

 // Defining the URL to hit to initiate the payment
 $url = "https://upi.infomattic.com/checkout.php";
 $checkout_type = "Default - Non Merchant";
}


// Generating the order id
$order_id = time();

// Defining the merchant id
$pid = "0208151248120";

//list($b_id,$bname,$email,$contact)=mysqli_fetch_array(mysqli_query($link,"SELECT `b_id`, `b_name`,`email`,`contact` FROM `bussiness` WHERE `b_id`='".$_GET['id']."'"));

list($acc_no,$name,$contact,$emi)=mysqli_fetch_array(mysqli_query($link,"SELECT `acc_no`,`name`,`mob_no`,`emi` FROM `customer` WHERE `acc_no`='".$_GET['acc_no']."'"));

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>UPI Gateway Integration</title>
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

          label{
              font-size: 14px;
              font-weight: 400;
              padding-top: 10px;
          }

          .order_id{
              font-size: 16px;
          }
      </style>
   </head>
   <body>
      <div class="container">
         <br><br>
         <h3 class="text-center">UPI Gateway Integration</h3>
         <p class="text-center">Checkout Type : <?php echo "$checkout_type"; ?></p>
         <br><br>
         <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
               <div class="well">
                   <p class="order_id">Order ID : <?php echo $order_id; ?></p>
                   <hr>
                  <form action="payment_exe.php" method="get">
                     <input type="hidden" name="orderid" value="<?php echo $order_id; ?>">
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Purpose of payment" value="<?php echo $name;?>" required>
                     </div>
                      <input type="hidden" name="acc_no" value="<?php echo $acc_no; ?>">
                     <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" class="form-control" name="mobile" placeholder="Purpose of payment" value="<?php echo $contact;?>" required>
                     </div>
                     <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="Amount" value="<?php echo $emi; ?>" readonly required>
                        <input type="hidden" name="inst_no" value="<?php echo $_GET['inst']; ?>">
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email id" value="<?php echo $email;?>" required>
                     </div>
                     <br>
                     <button type="submit" name="submit" class="btn btn-success btn-block">Proceed</button>
                  </form>
               </div>
            </div>
            <div class="col-sm-4">
            </div>
         </div>
      </div>
   </body>
</html>
