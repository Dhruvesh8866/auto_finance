<?php
include "connect.php";
$id=$_GET['id'];

$sql="delete from showroom where sh_id='$id'";
mysqli_query($link,$sql);
header('Location:showrooms.php');
?>