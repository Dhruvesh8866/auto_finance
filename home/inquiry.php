<?php 

include "connect.php";

echo $name=$_REQUEST['name'];
echo $email=$_REQUEST['email'];
echo $subject=$_REQUEST['subject'];
echo $comment=$_REQUEST['comments'];    


$sql="INSERT INTO `inquiry`(`name`, `email`, `subject`, `comment`) VALUES ('$name','$email','$subject','$comment')";

mysqli_query($link,$sql);


if(mysqli_affected_rows($link)>0)
{   
	header('Location:index.php');
    //$_SESSION['success']='Inquiry submitted Successfully...';
	
}
else{
    header('Location:index.php');
    //$_SESSION['fail']='Failed to submit inquiry...';
	//header('Location:pro2.php');
	//$_SESSION['msg']="<font color='#FF0000'>Failed to add record...</font>";
}



?>