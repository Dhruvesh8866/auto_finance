<?php include"connect.php";     
mysqli_query($link,"SELECT acc_no FROM `customer` WHERE `acc_no`='$_POST[val]'");

if(mysqli_affected_rows($link)>0)
{
    echo '1';

}else{
    
    echo '0';    
}
?>