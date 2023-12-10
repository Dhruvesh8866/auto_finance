<?php include "connect.php";     
    
    
mysqli_query($link,"SELECT password FROM `admin` WHERE `password`='$_POST[val]'");

if(mysqli_affected_rows($link)>0)
{
    echo '1';

}else{
    
    echo '0';    
//    $acc_no= $_POST[val];
//    if($acc_no==""){
//        
//    
//    }
//    else{
//        echo 0;
//    }
}
    
    

?>