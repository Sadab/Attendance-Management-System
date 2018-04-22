<?php  
include("database.php");
include("header.php");
session_start();
ob_start();

$cid=0;
if(isset($_REQUEST['cid'])){
    if(is_numeric($_REQUEST['cid'])){
        $cid=$_REQUEST['cid'];
    } else {
        header('location: index2.php');
    }
} else {
    header('location: index2.php');
}

if(isset($_POST['form1'])){
    if(is_numeric($_POST['student']) && check_duplicate($_POST['student'],$cid,$conn)){
        $sid = $_POST['student'];
        $time = time();
        $result=mysqli_query($conn,"insert into student_under_course(cid,sid,time) values('$cid','$sid','$time')");

        echo "<script type=\"text/javascript\">alert(\"Student Added!\");</script>";
    } else {
        echo "<script type=\"text/javascript\">alert(\"Something went wrong! System didn't recognise your input. Try Again.\");</script>";
    }
}

if(isset($_REQUEST['deleteStudent'])){
    $sid = $_REQUEST['deleteStudent'];
    if(is_numeric($sid)){
        $result=mysqli_query($conn,"delete from student_under_course where id=$sid");
        echo "<script type=\"text/javascript\">alert(\"Student removed!".$sid."\");</script>";
    } else {
        echo "<script type=\"text/javascript\">alert(\"Something went wrong! System didn't recognise your input. Try Again.\");</script>";
    }
}


if (!(isset($_SESSION['un']))){
    header("location:index.php");
}
	 
?>

<div class="card">
    <div class="panel card-header">
        	<h3>

			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                Add Student
            </button>

			<a class="btn btn-info float-right" href="course.php">View all Course</a>

		</h3>
       
        
		<h3><div class="well text-center">Date: <?php echo date("Y-m-d"); ?></div></h3>
        <div class="panel card-body">
           
                <table class="table table-striped table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
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
                            
                        </td>
                        <td>
                            <a href="studentList.php?cid=<?php echo $cid; ?>&deleteStudent=<?php echo $row['id']; ?>" class="btn btn-danger">Delete Student</a>
                        </td>
                    </tr>
                    <?php 
                		$counter++;
                		} 
                	?>
                </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="">
      <div class="modal-body">
        
            <label>Select Student</label>
            <select class="form-control" name="student">
                <?php 
                    $result=mysqli_query($conn, "select * from attendance"); 
                    while ($row=mysqli_fetch_array($result)) { 
                        echo "<option value='".$row['id']."'>".$row['student_name']."</option>";
                    }
                ?>
                
            </select>
            <br>
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="form1">Add Student</button>
      </div>
      </form>
    </div>
  </div>
</div>