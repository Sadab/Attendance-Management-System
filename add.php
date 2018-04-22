<?php 
	include( "header.php"); 
	include( "database.php"); 
	$flag=0; 
	if(isset($_POST['submit']))
	{ 
		$result=mysqli_query($conn,"insert into attendance(student_name,roll_number)values('$_POST[student_name]','$_POST[roll_number]')"); 
		if ($result) { $flag=1; } 
	} 
?>
<div class="card">
    <?php if($flag) { ?>
    <div class="alert alert-success">	<strong>Inserted</strong>
    </div>
    <?php } ?>
    <div class="card-header">
        	<h2>

			<a class="btn btn-success" href="add.php">Add student </a>

			<a class="btn btn-info float-right" href="index2.php">Back</a>

		</h2>
    </div>
    <div class="card-body">
        <form action="add.php" method="post">
            <div class="form-group">
                <label for="name">Student Name</label>
                <input type="text" name="student_name" id="student_name"
                class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Student Id</label>
                <input type="text" name="roll_number" id="roll_number"
                class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary"
                required>
            </div>
        </form>
    </div>
</div>