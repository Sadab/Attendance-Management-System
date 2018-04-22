<?php  
include("database.php");
include("header.php");

$cid=0;
$date="";

if(isset($_REQUEST['cid']) && isset($_REQUEST['date'])){
    if(is_numeric($_REQUEST['cid'])){
        $cid=$_REQUEST['cid'];
        $date = $_REQUEST['date'];
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

			<a class="btn btn-success" href="add.php">Add student</a>

			<a class="btn btn-info float-right" href="index2.php">Back</a>

		</h3>
        
        <div class="panel card-body">
            <form action="index2.php" method="post">
                <table class="table table-striped table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Attendance Status</th>
                    </tr>
                    <?php 
                    $result=mysqli_query($conn, 'select * from attendance_records where cid="'.$cid.'" and date="'.$date.'"'); 
                    $sNo=0; 
                    $counter=0;
                    while ($row=mysqli_fetch_array($result)) { 
                        $sNo++; 
                        $i=0;
                        $p=0;
                        $st = json_decode($row['sid'],true);
                        $at = json_decode($row['attendance_status'],true);
                        foreach ($st as $key) {
                            //echo $st[$i]."<br>";
                            $p++;
                        
                    ?>
                    <tr>
                        <td>
                            <?php echo $p; ?>
                        </td>
                        <td>
                            <?php echo student_details($st[$i],$conn); ?>
                            
                        </td>
                        <td>
                            <?php echo $at[$i]; ?>
                        </td>
                    </tr>
                    <?php 
                            $i++;  
                        }
                		$counter++;
                	} 
                	?>
                </table>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>