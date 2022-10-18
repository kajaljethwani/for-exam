<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-3">
 <center><b><h1>Login Page</h1><b></br></center>
	<form action="login_1.php" method="POST">
		<input type="email" name="txtmail" class="form-control" placeholder="Enter Mail Address" required></br>
		<input type="password" name="txtpass" class="form-control" placeholder="Enter Password" required></center></br>
		<center><input type="submit" name="btnlogin" value="Login" class="btn btn-success w-50">
	</form>
</div>
<?php
	$con = mysqli_connect("localhost","root","","kajal_1");
	if(!$con)
	{
		echo "Error DB!";
	}
	else
	{
		if(isset($_POST['btnlogin']))
		{
			$mail = $_POST['txtmail'];
			$pass = $_POST['txtpass'];
			$sql = "select * from `social_media` where `email`='$mail' and `password`='$pass'";
			$res = mysqli_query($con,$sql);
			$count  = mysqli_affected_rows($con);
			if($count == 1)
			{
				session_start();
				$_SESSION['social_media'] = $mail;
				header("location:home_page_1.php");
			}
			else
			{
				echo ("Invalid Username or Password!");
			}
		}
	}
?>