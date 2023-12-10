<?php
include "connect.php";
if($_GET['type']=="E")
{
header("Content-type: application/vnd.ms-xls");
$name='Showroom_Report'.'_'.time().'.xls';
header("Content-Disposition: attachment;Filename=$name");
}

?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="ThemeMakker">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Showroom report</title>

    <link rel="stylesheet" href="../assets/vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendor/fontawesome/css/font-awesome.min.css">
<!--    <link rel="stylesheet" href="../assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">-->
    <link rel="stylesheet" href="../assets/css/main.css" type="text/css">
    
      <!-- DataTables -->
      <link rel="stylesheet" href="datatable/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="datatable/responsive.bootstrap4.min.css">
</head>
    <h4><b>Showroom Report:</b></h4>
    <table border="1" width="100%" rules="all">
        <thead>
            <tr style="text-align:center;">
                <th> Showroom name </th>
                <th> Address </th>
                <th> City </th>
                <th> Contact </th>
                <th> Pincode </th>    
            </tr>
        </thead>
        <tbody>
                        
                        <?php
                            $sql="select * from showroom";
                          
                          $result=mysqli_query($link,$sql);
                          while($row=mysqli_fetch_array($result)) {
                          ?>
                          <tr>
                            <td><?php echo $row['sh_name']; ?></td>
                            <td><?php echo $row['sh_address']; ?></td>
                            <td><?php echo $row['sh_city']; ?></td>
                            <td><?php echo $row['sh_contact']; ?></td>
                            <td><?php echo $row['sh_pincode']; ?></td>
                            
                          </tr>
                    <?php } ?>
        </tbody>      
    </table>
<script>
    window.print();
</script>
    
</html>