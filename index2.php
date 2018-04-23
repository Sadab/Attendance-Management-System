<?php  
include("database.php");
include("header.php");
session_start();
ob_start();

if (!(isset($_SESSION['un']))){
    header("location:index.php");
}



$cid="";
if(isset($_REQUEST['cid'])){
    if(is_numeric($_REQUEST['cid'])){
        $cid=$_REQUEST['cid'];
    } else {
        header('location: index3.php');
    }
} else {
    header('location: index3.php');
}

 

	 $flag=0;
     $update=0;
	if(isset($_POST['submit'])){
		//print_r($_POST);
		//die();
        $date = date("Y-m-d");

        $sids = json_encode($_POST['sid']);
        $attend = json_encode($_POST['attendance_status']);

        /*echo $sids."<br>";
        echo $attend."<br>";

        $i=0;
        $st = json_decode($attend,true);
        foreach ($st as $key) {
            echo $st[$i]."<br>";
            $i++;        
        }*/

        $result=mysqli_query($conn,"insert into attendance_records(sid,cid,attendance_status,date) values('$sids','$cid','$attend','$date')");
        echo "<script type=\"text/javascript\">alert(\"Attendance Stored Succesfully!\");</script>";



    //     $records=mysqli_query($conn,"select * from attendance_records where date='$date'");
    //     $num=mysqli_num_rows($records);
    //     if($num){
    //         foreach ($_POST['attendance_status'] as $id => $attendance_status) {
    //             $sID = (int)$id;
    //             $student_name = array_values($_POST['student_name'])[$sID];
    //             $roll_number = array_values($_POST['roll_number'])[$sID];
                
    //             $result=mysqli_query($conn,"update attendance_records set attendance_status='$attendance_status' where date='$date'");
    //             if($result){
    //                 $update=1;
    //             }
    //         }
    //     }
    //     else{
    // 		foreach ($_POST['attendance_status'] as $id => $attendance_status) {
    // 			$sID = (int)$id;
    // 			$student_name = array_values($_POST['student_name'])[$sID];
    // 			$roll_number = array_values($_POST['roll_number'])[$sID];
    			
    // 			$result=mysqli_query($conn,"insert into attendance_records(student_name,roll_number,attendance_status,date) values('$student_name','$roll_number','$attendance_status','$date')");
    //             if($result){
    //                 $flag=1;
    //             }
    // 		}
	   // }
    }

    if(check_duplicate_date($cid,$conn)==1){
        header('location: index3.php');
    }
?>

<div class="card">
    <div class="panel card-header">
        	<h3>

			<a class="btn btn-success" href="add.php">Add strudent</a>

			<a class="btn btn-info float-right" href="viewall.php">View all</a>

		</h3>
        <?php if($flag) { ?>
        <div class="alert alert-success">
            <strong>Submitted</strong>
        </div>
        <?php } ?>

        <?php if($update) { ?>
        <div class="alert alert-success">
            <strong>Updated</strong>
        </div>
        <?php } ?>
        
		<h3><div class="well text-center">Date: <?php echo date("Y-m-d"); ?></div></h3>
        <div class="panel card-body">
            <form action="" method="post">
                <table class="table table-striped table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Attendance Status</th>
                    </tr>
                    <?php 
                    $result=mysqli_query($conn, "select * from student_under_course where cid=$cid"); 
                    $sNo=0; 
                    $counter=0;
                    while ($row=mysqli_fetch_array($result)) { 
                        $sNo++; 
                    ?>
                    <tr>
                        <td>
                            <?php echo $sNo; ?>
                        </td>
                        <td>
                            <?php echo student_details($row['sid'],$conn); ?>
                            <input type="hidden" value="<?php echo $row['sid']; ?>" name="sid[]">
                        </td>
                        <td>
                            <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Present"> Present
                            <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Absent" checked> Absent
                        </td>
                    </tr>
                    <?php 
                		$counter++;
                		} 
                	?>
                </table>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
