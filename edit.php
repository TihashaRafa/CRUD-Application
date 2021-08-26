<?php  include_once "app/autoload.php"; ?>

<?php
/**
 * Add new student isset
 */

if(isset($_POST['add'])){
	//get value 
	$edit_id = $_GET['edit_id'];

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
	 * form validation
	 */


	 if(empty($name) || empty($email) || empty($cell) || empty($uname) ||empty($age)|| empty($gender) || empty($shift) || empty($location)){
		$msg = validationMsg('All fileds are required!');
	 }elseif(filter_var($email, FILTER_VALIDATE_EMAIL) ==false) {
		$msg = validationMsg('Wrong Email Address!', 'info');
	 }elseif($age <=5 || $age>=12){
		 $msg= validationMsg('Age is not ok!', 'warning');
	 }else{
	
		//flag variable, 
		$photo_name ='';
		if(empty($_FILES['new_photo']['name'])){
			$photo_name= $_POST['old_photo'];
		}else{
			// img upload
		$file_name = $_FILES['new_photo']['name'];
		$file_tmp_name = $_FILES['new_photo']['tmp_name'];
		$file_tmp_size = $_FILES['new_photo']['size'];
		$photo_name = md5(time(). rand()). $file_name;

		move_uploaded_file ($file_tmp_name, 'photo/students/'.$photo_name);

		}
	 // update data in database connection 
		$sql = "UPDATE students SET name='$name', email='$email', cell='$cell', uname='$uname', age='$age', gender='$gender', shift='$shift', location='$location', photo='$photo_name' WHERE id='$edit_id' ";
		$connection -> query($sql);

		$msg = validationMsg('Data Updated!', 'success');
	 }
}

?>

<?php
if(isset($_GET['edit_id'])){
	$edit_id = $_GET['edit_id'];

	$sql = " SELECT * FROM students WHERE id = '$edit_id' ";
	$data = $connection -> query($sql);

	$singleData = $data -> fetch_assoc();
	
}

?>
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

	<div class="wrap shadow">
		<a class="btn btn-sm btn-primary" href="students.php">Back</a>

		<div class="card">
			<div class="card-body">
				<h2>Update student</h2>
				<?php
					if(isset($msg)){
						echo $msg;
					}				
				
				?>
				
				<form action="" method='POST' enctype='multipart/form-data'>

					<div class="form-group">
						<label for="">Name</label>
						<input class="form-control" value="<?php echo $singleData['name']; ?>" name="name" type="text">
					</div>
					
					<div class="form-group">
						<label for="">Email</label>
						<input class="form-control" value="<?php echo $singleData['email']; ?>" name="email" type="email">
					</div>

					<div class="form-group">
						<label for="">Cell</label>
						<input class="form-control" value="<?php echo $singleData['cell']; ?>" name="cell" type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input class="form-control" value="<?php echo $singleData['uname']; ?>" name="uname" type="text">
					</div>
					<div class="form-group">
						<label for="">Age</label>
						<input class="form-control" value="<?php echo $singleData['age']; ?>" name="age" type="text">
					</div>
					<div class="form-group">
						<label for="">Gender</label><br>
						<input <?php if($singleData['gender']== 'male') {echo "checked"; } ?> value="male"  name="gender" type="radio" id="male"><label for="male">Male</label>
						<input <?php if($singleData['gender']== 'female') {echo "checked"; } ?> value="female"  name="gender" type="radio" id="female"><label for="female">Female</label>
					</div>

					<div class="from-group">
					<label for="">shift</label>
					<select class="form-control" name="shift" id="">
					<option value="">Select</option>
					<option <?php if($singleData['shift']== 'Day') {echo "selected"; } ?> value="Day">Day</option>
					<option <?php if($singleData['shift']== 'Evening') {echo "selected"; } ?> value="Evening">Evening</option>
					</select>
					
					</div>

					<div class="form-group">
						<label for="">Location</label>
						<select class="form-control" name="location" id="">
						<option <?php if($singleData['location']== 'Select') {echo "selected"; } ?>  value="">Select</option>
						<option <?php if($singleData['location']== 'Dhaka') {echo "selected"; } ?> value="Dhaka">Dhaka</option>
						<option <?php if($singleData['location']== 'Chittagong') {echo "selected"; } ?> value="Chittagong">Chittagong</option>
						<option <?php if($singleData['location']== 'Khulna') {echo "selected"; } ?> value="Khulna">Khulna</option>
						<option <?php if($singleData['location']== 'Rajshahi') {echo "selected"; } ?> value="Rajshahi">Rajshahi</option>
						<option <?php if($singleData['location']== 'Borisal') {echo "selected"; } ?> value="Borisal">Borisal</option>
						<option <?php if($singleData['location']== 'MymonSing') {echo "selected"; } ?> value="MymonSing">MymonSing</option>
						<option <?php if($singleData['location']== 'Rongpur') {echo "selected"; } ?> value="Rongpur">Rongpur</option>
						<option <?php if($singleData['location']== 'Sylhet') {echo "selected"; } ?> value="Sylhet">Sylhet</option>
						</select>
					</div>
					<div class="form-group">
					<img style="width:200px;" src="photo/students/<?php echo $singleData['photo']; ?>" alt="">
					<input name="old_photo" value="<?php echo $singleData['photo']; ?>" type="hidden">
					</div>	
					<div class="form-group">
					<label for="">Photo</label>
					<input class="form-control-file" type="file" name="new_photo">
					</div>

					<div class="form-group">
						<input name='add' class="btn btn-primary" type="submit" value="update now">
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