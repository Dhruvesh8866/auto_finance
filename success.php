

<?php 
//paste this file in xampp/htdocs for auto finance paytm gateway 
include"auto_finance/light/connect.php"; 
$suc=$_GET['status'];
$orderid=$_GET['orderid'];
if($suc=='SUCCESS')
{
    mysqli_query($link,"UPDATE `temp` SET `status`='Success' WHERE orderid=$orderid");
    list($acc_no,$inst_no)=mysqli_fetch_array(mysqli_query($link,"SELECT `acc_no`,inst_no FROM `temp` WHERE `orderid`=$orderid"));
    list($amount,$emi_capital,$emi_interest)=mysqli_fetch_array(mysqli_query($link,"Select emi,emi_capital,emi_interest from customer where acc_no=$acc_no"));
    list($emi_date)=mysqli_fetch_array(mysqli_query($link,"Select inst_date from cust_inst_record where inst_no=$inst_no and acc_no=$acc_no"));
    $sqll="INSERT INTO `payment`(`acc_no`,`inst_no`,`amount`,`type`,`emi_date`,`pay_date`,`fine`,`inst_clear`,`emi_capital`,`emi_interest`,`cheque_no`,`cheque_date`) VALUES ('$acc_no','$inst_no','$amount','Online','$emi_date',CURDATE(),'0','Yes','$emi_capital','$emi_interest','','')";
mysqli_query($link,$sqll);
    if(mysqli_affected_rows($link)>0){

    $sql1="UPDATE `cust_inst_record` SET `inst_clear`='Yes' WHERE `acc_no`='$acc_no' and `inst_no`='$inst_no'";
    mysqli_query($link,$sql1);}
} 
//header( "Location:new/light/customer_home.php" );
//header("refresh:5;url=new/light/customer_home.php");


?>
<html>
   <head>
       
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <style type="text/css">

    body
    {
        background:#f2f2f2;
    }

    .payment
	{
		border:1px solid #f2f2f2;
		height:280px;
        border-radius:20px;
        background:#fff;
	}
   .payment_header
   {
	   background:rgba(255,102,0,1);
	   padding:20px;
       border-radius:20px 20px 0px 0px;
	   
   }
   
   .check
   {
	   margin:0px auto;
	   width:50px;
	   height:50px;
	   border-radius:100%;
	   background:#fff;
	   text-align:center;
   }
   
   .check i
   {
	   vertical-align:middle;
	   line-height:50px;
	   font-size:30px;
   }

    .content 
    {
        text-align:center;
    }

    .content  h1
    {
        font-size:25px;
        padding-top:25px;
    }

    .content a
    {
        width:200px;
        height:35px;
        color:#fff;
        border-radius:30px;
        padding:5px 10px;
        background:rgba(255,102,0,1);
        transition:all ease-in-out 0.3s;
    }

    .content a:hover
    {
        text-decoration:none;
        background:#000;
    }
   
       </style>
       <script>
            function countDown(secs,elem) {

                var element = document.getElementById(elem);

                element.innerHTML = "You will be redirected within "+secs+" seconds";

                if(secs < 1) {

                    clearTimeout(timer);

                    element.innerHTML = "You will be redirected within "+0+" seconds";
                    <?php 
                        header("refresh:10;url=auto_finance/light/customer_home.php");
                    ?>
            }

            secs--;

            var timer = setTimeout('countDown('+secs+',"'+elem+'")',1000);

            }
       </script>
   </head>
    <body>
        <div class="container">
           <div class="row">
              <div class="col-md-6 mx-auto mt-5">
                 <div class="payment">
                   <?php if($suc=='SUCCESS'){ ?>
                    <div class="payment_header">              
                       <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
                    </div>
                    <div class="content">
                       <h1>Payment Success !</h1>
                       <?php } else {?>
                       <div class="payment_header">              
                       <div class="check"><i class="fa fa-warning" aria-hidden="true"></i></div>
                    </div>
                    <div class="content">
                       <h1>Payment Failed !</h1>
                       <?php } ?>
                       <p id="status"></p>
                       <script>countDown(10,"status");</script> 
                       <a href="auto_finance/light/customer_home.php">Go to Home</a>
                    </div>

                 </div>
              </div>
           </div>
        </div>
     </div>
     
    </body>        
</html>