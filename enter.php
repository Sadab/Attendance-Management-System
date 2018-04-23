<?php
session_start();
ob_start();
require ('database.php');

$un=$_POST['un'];
$pw=$_POST['pw'];

$sql="SELECT * FROM user WHERE un='$un' and pw=md5('$pw')";
$result=mysqli_query($conn,$sql);

$count=mysqli_num_rows($result);


if($count==1){

    $_SESSION['un']=$un;
    header("location:index3.php");
    mysqli_close($conn);
}
else {
    header("location:index.php");
    mysqli_close($conn);
}
ob_end_flush();
 
?>
