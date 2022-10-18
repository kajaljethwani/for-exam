<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-3">
 <center><b><h1>Register Page</h1><b></br></center>
	<form action="register_1.php" method="POST">
		<input type="text" name="txtnm" class="form-control" placeholder="Enter Name" required></br>
		<input type="email" name="txtmail" class="form-control" placeholder="Enter Mail Address" required></br>
		<input type="text" name="txtmob" class="form-control" placeholder="Enter Mobile No." required></br>
		<input type="password" name="txtpass" class="form-control" placeholder="Enter Password" required></center></br>
		<center><input type="submit" value="Register" class="btn btn-primary w-50">
	</form>
</div>
<?php
	$con = mysqli_connect("localhost","root","","kajal_1");
	if(isset($_POST['txtnm']))
	{
		if($con)
		{
			$nm=$_POST['txtnm'];
			$email=$_POST['txtmail'];
			$mob=$_POST['txtmob'];
			$password=$_POST['txtpass'];
			$sql="INSERT INTO `social_media`(`name`, `email`, `mobile`, `password`) VALUES ('$nm','$email','$mob','$password')";
			$res=mysqli_query($con,$sql);
			header("location:login_1.php");
		}
	}
?>

