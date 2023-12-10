<?php 
session_start();
include"connect.php";

$o_pass=$_REQUEST['o_pass'];
$n_pass=$_REQUEST['n_pass'];
$c_pass=$_REQUEST['c_pass'];
if($n_pass==$c_pass){
    $sql= "UPDATE `admin` SET `password`='$n_pass' WHERE `password`='$o_pass'";
    mysqli_query($link,$sql);
    if(mysqli_affected_rows($link)>0){
        header('Location:change_password.php');
        $_SESSION['success']='Password updated Successfully...';
    }
    else{
        header('Location:change_password.php');
        $_SESSION['fail']='Old password is incorrect';
    }
}
else{
    header('Location:change_password.php');
    $_SESSION['fail']='New passowrd and Confirm password are not same';
}
 
?>