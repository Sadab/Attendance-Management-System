<!DOCTYPE html>
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">


<?php 
function user_details($user_id,$con){
	$result=mysqli_query($con, "select * from user where id=$user_id");
	$un = "";
	while ($row=mysqli_fetch_array($result)) { 
    	$un = $row['un'];
    }
	
	return $un;
}

function getUserID($uns,$con){
	$result=mysqli_query($con, "select * from user where un='$uns'");
	$un = "";
	while ($row=mysqli_fetch_array($result)) { 
    	$un = $row['id'];
    }
	
	return $un;
}

function student_details($user_id,$con){
	$result=mysqli_query($con, "select * from attendance where id=$user_id");
	$un = "";
	while ($row=mysqli_fetch_array($result)) { 
    	$un = $row['student_name'];
    }
	
	return $un;
}

function check_duplicate($user_id,$cid,$con){
	$result=mysqli_query($con, "select * from student_under_course where sid=$user_id and cid=$cid");
	$un = 0;
	while ($row=mysqli_fetch_array($result)) { 
    	$un++;
    }
	
	if($un>0){
		return false;
	} else {
		return true;
	}
}

function check_duplicate_course($user_id,$cname,$con){
	$result=mysqli_query($con, "select * from course where faculty=$user_id and course='$cname'");
	$un = 0;
	while ($row=mysqli_fetch_array($result)) { 
    	$un++;
    }
	
	if($un>0){
		return false;
	} else {
		return true;
	}
}

function check_duplicate_date($cid,$con){
	$d = date("Y-m-d");
	$result=mysqli_query($con, "select * from attendance_records where cid=$cid and date='$d'");
	$un = 0;
	while ($row=mysqli_fetch_array($result)) { 
    	$un++;
    }
	//echo $cid."<br>".$d."<br>".$un."<br>";
	if($un>0){
		return 1;
	} else {
		return 0;
	}
}
?>


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<div class="container">
	<h1><div class="well text-center">Attendance Management System Beta</div></h1>
</div>