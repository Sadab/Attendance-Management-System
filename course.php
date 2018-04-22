<?php  
include("database.php");
include("header.php");
session_start();
ob_start();


if (!(isset($_SESSION['un']))){
    header("location:index.php");
}

if(isset($_POST['form1'])){
    if(check_duplicate_course($_POST['faculty'],$_POST['course_name'],$conn)){
        $sid = $_POST['faculty'];
        $cname = $_POST['course_name'] ;
        $time = time();
        $result=mysqli_query($conn,"insert into course(faculty,course) values('$sid','$cname')");

        echo "<script type=\"text/javascript\">alert(\"Course Added!\");</script>";
    } else {
        echo "<script type=\"text/javascript\">alert(\"Something went wrong! System didn't recognise your input. Try Again.\");</script>";
    }
}
	 
?>

<div class="card">
    <div class="panel card-header">
        <h3>
        	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                Add Course
            </button>

			<a class="btn btn-info float-right" href="index3.php">back</a>

		</h3>
       
        
		<h3><div class="well text-center">Date: <?php echo date("Y-m-d"); ?></div></h3>
        <div class="panel card-body">
           
                <table class="table table-striped table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Faculty Name</th>
                        <th>Students</th>
                    </tr>
                    <?php 
                    $result=mysqli_query($conn, "select * from course"); 
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
                            <?php echo $row['course']; ?>
                            
                        </td>
                        <td>
                            <?php echo user_details($row['faculty'],$conn); ?>
                            
                        </td>
                        <td>
                            <a href="studentList.php?cid=<?php echo $row['cid']; ?>" class="btn btn-primary">View All Student</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="">
      <div class="modal-body">
      		<label>Course Name</label>
        	<input type="text" class="form-control" name="course_name"><br>
            <label>Select Faculty</label>
            <select class="form-control" name="faculty">
                <?php 
                    $result=mysqli_query($conn, "select * from user"); 
                    while ($row=mysqli_fetch_array($result)) { 
                        echo "<option value='".$row['id']."'>".$row['un']."</option>";
                    }
                ?>
                
            </select>
            <br>
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="form1">Add Course</button>
      </div>
      </form>
    </div>
  </div>
</div>