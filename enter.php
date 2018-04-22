<?php
/**
 * Created by PhpStorm.
 * User: Saef
 * Date: 08-Mar-16
 * Time: 9:44 AM
 */
session_start();
ob_start();
require ('database.php');
// username and password sent from form
$un=$_POST['un'];
$pw=$_POST['pw'];

// To protect MySQL injection (more detail about MySQL injection) sanitize your data here. best practice is to use a sanitize
//function


//use db connection method here to access data from database

 $sql="SELECT * FROM user WHERE un='$un' and pw=md5('$pw')";
 $result=mysqli_query($conn,$sql);



// Mysql_num_row is counting table row
 $count=mysqli_num_rows($result);

// If result matched $un and $pw, table row must be 1 row

if($count==1){

    $_SESSION['un']=$un;
    //close the db connection here
    header("location:index3.php");
}
else {
    //close the db connection here
    header("location:index.php");
}
//close the db connection here
ob_end_flush();
 ?>
