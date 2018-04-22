<?php  
	include("database.php");
	include("header.php");

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

?>

<div class="card">
    <div class="panel card-header">
        	<h3>

			<a class="btn btn-success" href="add.php">Add strudent</a>

			<a class="btn btn-info float-right" href="index2.php">Back</a>

		</h3>
        
        <div class="panel card-body">
                <table class="table table-striped table-dark">
                    <tr>
                        <th>#</th>
                        <th>Attendance Records</th>
                        <th>Show Attendance</th>
                    </tr>
                    <?php 
                    $result=mysqli_query($conn, "select distinct date from attendance_records where cid=$cid"); 
                    $sNo=0; 
                    while ($row=mysqli_fetch_array($result)) { 
                        $sNo++; 
                    ?>
                    <tr>
                        <td>
                            <?php echo $sNo; ?>
                        </td>
                        <td>
                            <?php echo $row['date']; ?>
               
                        </td>
                        <td>
                        	<a href="showattendance.php?cid=<?php echo $cid?>&date=<?php echo $row['date'] ?>" class="btn btn-primary">Show Attendance</a>
                        </td>
                        
                    </tr>
                    <?php 
                	
                		} 
                	?>
                </table>
                
        </div>
    </div>
</div>