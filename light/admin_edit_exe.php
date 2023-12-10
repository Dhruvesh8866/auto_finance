<?php
session_start();
include "connect.php";


//$photo=time().$_FILES['photo']['name'];
$photo=$_FILES['photo']['name'];
$path="upload/".$photo;
move_uploaded_file($_FILES['photo']['tmp_name'],$path);

$b_name=$_REQUEST['b_name'];
$b_address=$_REQUEST['b_address'];
$b_contact=$_REQUEST['b_contact'];
$b_pincode=$_REQUEST['b_pincode'];
$benif_name=$_REQUEST['benif_name'];
$benif_acc=$_REQUEST['benif_acc'];
$benif_ifsc=$_REQUEST['benif_ifsc'];
$branch=$_REQUEST['branch'];
$m_id=$_REQUEST['m_id'];
$m_key=$_REQUEST['m_key'];


//$sql="UPDATE `showroom` SET `sh_name`='$showroom_name', `sh_address`='$showroom_address', `sh_city`='$showroom_city', `sh_contact`='$showroom_contact', `sh_pincode`='$showroom_pincode' where `sh_id`='$id'";
if($photo==""){
    $sql= "UPDATE `admin` SET `business_name`='$b_name',`business_address`='$b_address',`business_contact`='$b_contact',`pincode`='$b_pincode',`benif_name`='$benif_name',`benif_acc`='$benif_acc',`benif_ifsc`='$benif_ifsc',`branch`='$branch',`m_id`='$m_id',`m_key`='$m_key'";
    
}

else{
$sql= "UPDATE `admin` SET `business_name`='$b_name',`business_address`='$b_address',`business_contact`='$b_contact',`pincode`='$b_pincode',`benif_name`='$benif_name',`benif_acc`='$benif_acc',`benif_ifsc`='$benif_ifsc',`branch`='$branch',`m_id`='$m_id',`m_key`='$m_key',`logo`='$photo'";
}
    
    
mysqli_query($link,$sql);

if(mysqli_affected_rows($link)>0)
{
	header('Location:admin_edit.php');
	$_SESSION['success']='Profile updated Successfully...';
	
	}
else{
	header('Location:admin_edit.php');
	$_SESSION['fail']='error! Failed to update...';
		
	}
?>