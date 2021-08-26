
<?php  include_once "app/autoload.php"; ?>
<?php   
// student id(database) get from url 
// somehow url show na korle isset use korte hobe 

if(isset($_GET['student_id'])){

	$student_id = $_GET['student_id'];
	// database id and and query run and get the value from database
	$sql = "SELECT * FROM students WHERE id ='$student_id' ";
	$data =$connection -> query($sql);

	$single_student = $data -> fetch_assoc();


}



?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">

	<style>
	.profile{
		font-family: serif;
	}
	
	.profile img{
		width: 200px;
		height: 200px;
		display: block;
		margin: auto;
		border: 2px solid black;
		border-radius: 50%;


	}
	.profile h2{
		text-align: center;
		font-family: serif;
	}
	
	
	</style>

</head>
<body>
		
	

	<div class="wrap">
	
		<a class="btn btn-sm btn-primary" href="students.php">All students</a>

		<div class="card shadow">
			<div class="card-body profile">
			<!-- get data from url in manually -->
			<!-- <h1>
			<?php   
				// echo $_GET['student_id'];
			
			
			?> 
			</h1> -->
															<!-- get photo from database -->
				<img class="shadow " src="photo/students/<?php echo $single_student['photo']; ?>" alt="">
				<h2><?php echo $single_student['name']; ?></h2>


				<table class="table table-striped">
				<!-- single data view -->
					<thead>
					<tr>
						<td>username</td>
						<td><?php echo $single_student['uname']; ?></td>
					</tr>

					<tr>
						<td>email</td>
						<td><?php echo $single_student['email']; ?></td>
					</tr>
					<tr>
						<td>gender</td>
						<td><?php echo $single_student['gender']; ?></td>
					</tr>
					<tr>
						<td>age</td>
						<td><?php echo $single_student['age']; ?></td>
					</tr>
					<tr>
						<td>location</td>
						<td><?php echo $single_student['location']; ?></td>
					</tr>
					<tr>
						<td>shift</td>
						<td><?php echo $single_student['shift']; ?></td>
					</tr><tr>
						<td>cell</td>
						<td><?php echo $single_student['cell']; ?></td>
					</tr>

					</thead>				
				</table>
			</div>
		</div>
	</div>







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>