
<?php  include_once "app/autoload.php"; ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<link rel="stylesheet" href="assets/fonts/font_awesome/css/all.css">
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

<?php
/**
 * Add new student isset
 */

if(isset($_POST['add'])){
	//get value 

	$name = $_POST['name'];
	$email = $_POST['email'];
	$cell = $_POST['cell'];
	$uname = $_POST['uname'];
	$age = $_POST['age'];
	if(isset($_POST['gender'])){
		 $gender = $_POST['gender'];
	}
	$shift = $_POST['shift'];
	$location = $_POST['location'];


	/**
	 * photo upload
	 */


$file_name = $_FILES['photo']['name'];
$file_tmp_name = $_FILES['photo']['tmp_name'];
$file_tmp_size = $_FILES['photo']['size'];
$unique_file_name = md5(time(). rand()). $file_name;



	/**
	 * form validation
	 */


	 if(empty($name) || empty($email) || empty($cell) || empty($uname) ||empty($age)|| empty($gender) || empty($shift) || empty($location)|| empty($unique_file_name)){
		$msg = validationMsg('All fileds are required!');
	 }elseif(filter_var($email, FILTER_VALIDATE_EMAIL) ==false) {
		$msg = validationMsg('Wrong Email Address!', 'info');
	 }elseif($age <=5 || $age>=12){
		 $msg= validationMsg('Age is not ok!', 'warning');
	 }else{
		 // database connection 
		$connection -> query("INSERT INTO students(name, email, cell, uname, age, gender, shift, location, photo) VALUES('$name', '$email', '$cell', '$uname', '$age', '$gender', '$shift', '$location', '$unique_file_name') "); 
		move_uploaded_file ($file_tmp_name, 'photo/students/'.$unique_file_name);
		$msg = validationMsg('Data Stable!', 'success');
	 }
}

?>

	<div class="wrap shadow">
		<a class="btn btn-sm btn-primary" href="students.php">All data</a>

		<div class="card">
			<div class="card-body">
				<h2>Add New student</h2>
				<?php
					if(isset($msg)){
						echo $msg;
					}				
				
				?>
				
				<form action="" method='POST' enctype='multipart/form-data'>

					<div class="form-group">
						<label for="">Name</label>
						<input class="form-control"  name="name" type="text">
					</div>
					
					<div class="form-group">
						<label for="">Email</label>
						<input class="form-control"  name="email" type="email">
					</div>

					<div class="form-group">
						<label for="">Cell</label>
						<input class="form-control" name="cell" type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input class="form-control" name="uname" type="text">
					</div>
					<div class="form-group">
						<label for="">Age</label>
						<input class="form-control" name="age" type="text">
					</div>
					<div class="form-group">
						<label for="">Gender</label><br>
						<input checked value="male"  name="gender" type="radio" id="male"><label for="male">Male</label>
						<input value="female"  name="gender" type="radio" id="female"><label for="female">Female</label>
					</div>

					<div class="from-group">
					<label for="">shift</label>
					<select class="form-control" name="shift" id="">
					<option value="">Select</option>
					<option value="Day">Day</option>
					<option value="Evening">Evening</option>
					</select>
					
					</div>

					<div class="form-group">
						<label for="">Location</label>
						<select class="form-control" name="location" id="">
						<option value="">Select</option>
						<option value="Dhaka">Dhaka</option>
						<option value="Chittagong">Chittagong</option>
						<option value="Khulna">Khulna</option>
						<option value="Rajshahi">Rajshahi</option>
						<option value="Borisal">Borisal</option>
						<option value="MymonSing">MymonSing</option>
						<option value="Rongpur">Rongpur</option>
						<option value="Sylhet">Sylhet</option>
						</select>
					</div>

					<div class="form-group">
					<label for="">Photo</label>
					<input class="form-control-file" type="file" name="photo">
					</div>

					<div class="form-group">
						<input name='add' class="btn btn-primary" type="submit" value="Add new student">
					</div>
				</form>
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