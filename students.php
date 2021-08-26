<?php include_once "app/autoload.php"; ?>

<?php
// data delete 
if(isset($_GET['delete_id'])){

	$delete_id = $_GET['delete_id'];
	//get photo 
	$photo_delete = $_GET['photo'];

	$sql = "DELETE FROM students WHERE id='$delete_id' ";
	$connection -> query($sql);

	// photo delete from folder
	unlink('photo/students/' . $photo_delete );


	//use for no get url id 
	header("location:students.php");


}

/**
 * Active a user
 */
if(isset($_GET['active_id'])){
	$active_id = $_GET['active_id'];

	$sql = "UPDATE students SET status='active' WHERE id = '$active_id'  ";
	$connection -> query($sql);

	header("location:students.php");
}



/**
 * inactive a user
 */
if(isset($_GET['inactive_id'])){
	$inactive_id = $_GET['inactive_id'];

	$sql = "UPDATE students SET status='inactive' WHERE id = '$inactive_id'  ";
	$connection -> query($sql);

	header("location:students.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/fonts/font_awesome/css/all.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	<div class="wrap-table ">

	<a class="btn btn-sm btn-primary" href="index.php">Add New student</a>

		<div class="card shadow">
			<div class="card-body">
				<h2>All Students</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Gender</th>
							<th>Email</th>
							<th>cell</th>
							<th>age</th>
							<th>shift</th>
							<th>location</th>
							<th>photo</th>
							<th>action</th>

						</tr>
					</thead>
					<tbody>
						
							<!-- LIMIT 2 -->
							<!-- order by- ORDER BY location DESC -->
							<!-- WHERE id='4' -->
							<!-- WHERE location='Dhaka' OR location ='Chittagong' -->
							<!-- WHERE location='Dhaka' AND gender='female' -->
							<!-- WHERE NOT location='Dhaka' -->
							<!-- WHERE NOT location='Dhaka' AND NOT gender= 'female' -->
							<!-- WHERE updated_at IS NULL -->
							<!-- WHERE updated_at IS NOT NULL -->
							<!-- id, name AS naam, email, cell, age, shift, location, status, gender,photo  -->
							<!-- WHERE name LIKE 'a%a ' -->
							<!-- WHERE location IN ('DHAKA', 'chittagong' ) -->
							<!-- WHERE location NOT IN ('DHAKA', 'chittagong' ) -->
							<!-- WHERE age BETWEEN 1 AND 10  -->
						<?php
						

							// min, max, sum, count, avarage
							// $min_age =$connection ->query("SELECT MIN(age) FROM AS minage FROM students "); 
							// $age = $min_age -> fetch_assoc();
							// echo $age['minage'];


							//data from database
							 $data =$connection ->query("SELECT * FROM students "); 
							//serial number 
							$i =1;
							while($student = $data -> fetch_assoc() ) :
						
						
						?>


						<tr>
							<td><?php echo $i; $i++;  ?></td>
							<td><?php echo $student['name']; ?></td>
							<td><?php echo $student['gender']; ?></td>
							<td><?php echo $student['email']; ?></td>
							<td><?php echo $student['cell']; ?></td>
							<td><?php echo $student['age']; ?></td>
							<td><?php echo $student['shift']; ?></td>
							<td><?php echo $student['location']; ?></td>
							<td> <img src="photo/students/<?php echo $student['photo']; ?> " alt=""> </td>
							
							<td> 
							<!-- status -->
							<?php  if($student['status'] == 'inactive') : ?>
								<a class="btn btn-sm btn-danger" href="?active_id=<?php echo $student['id']; ?>"><i class="far fa-thumbs-up"></i></a>
							<?php  elseif($student['status'] == 'active') :  ?>
								<a class="btn btn-sm btn-success" href="?inactive_id=<?php echo $student['id']; ?>"><i class="far fa-thumbs-down"></i></a>
							<?php  endif; ?>
							<!-- student id from database -->
							<a class="btn btn-sm btn-info" href="profile.php?student_id=<?php echo $student['id']; ?>"><i class="far fa-eye"></i></a>
							<a class="btn btn-sm btn-warning" href="edit.php?edit_id=<?php echo $student['id']; ?>"><i class="far fa-edit"></i></a>
							<a id="delete_btn" class="btn btn-sm btn-danger" href="?delete_id=<?php echo $student['id']; ?>&photo=<?php echo $student['photo']; ?>"><i class="fas fa-trash-alt"></i></a>
							</td>
							
						</tr>

						<?php   endwhile; ?>	

					</tbody>
				</table>
			</div>
		</div>
	</div>
	

	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>
	// delete er age msg
		$('a#delete_btn').click(function(){
			let conf = confirm('Are you sure?');

			if(conf == true){
				return true;
			}else{
				return false;
			}
		});
	</script>
</body>
</html>