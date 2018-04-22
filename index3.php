<?php  
include("database.php");
include("header.php");
session_start();
ob_start();


if (!(isset($_SESSION['un']))){
    header("location:index.php");
}
	 
?>

<div class="card">
    <div class="panel card-header">
        <h3>
            <a class="btn btn-success" href="course.php">Course Management</a>
			

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
                    //echo $_SESSION['un'];
                    $uid = getUserID($_SESSION['un'],$conn);

                    $result=mysqli_query($conn, "select * from course where faculty=$uid"); 
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
                            <a href="viewall.php?cid=<?php echo $row['cid']; ?>" class="btn btn-primary">View All attendance</a>
                            <a href="index2.php?cid=<?php echo $row['cid']; ?>" class="btn btn-success">Start attendance</a>
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