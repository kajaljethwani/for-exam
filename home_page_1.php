
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/css/bootstrap.min.css"/>
<?php
	session_start();
	if(!$_SESSION['social_media'])
	{
		header("location:login_1.php");
	}
	$con = mysqli_connect("localhost","root","","kajal_1");
	if(!$con)
	{
		echo "Error DB!";
	}
	else
	{
		$oldmail = $_SESSION['social_media'];
		$sql = "select * from `social_media` where email='$oldmail'";
		$res = mysqli_query($con,$sql);
	}
?>
<div class="container-fluid mt-2 text-center">
	<?php
			$count  = mysqli_affected_rows($con);
			if($count == 1)
			{
				$row = mysqli_fetch_assoc($res);
			}
		?>
	<form action="home_page_1.php" method="POST" enctype="multipart/form-data">
		<?php
			if($row['profile_pic']!="")
			{
		?>
		<img class="img-circle" src="<?php echo "images/".$row['profile_pic']; ?>" alt="No Image" height="150" width="150" name="usrimg" id="usrimg"></br>
		<?php echo $row['email']; ?>
		<?php
			}
			if($row['profile_pic']=="")
			{
		?>
		<img class="img-circle" src="https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png" alt="No Image" height="150" width="150" name="usrimg" id="usrimg"></br></br>
		<?php echo $row['email']; ?>
		
		<input type="file" class="form-control" id="fileupload" name="fileupload" accept=".JPEG,.JPG,.PNG"></br></br>
		<?php
			}
		?>
		<input type="text" value="<?php echo $row['name']; ?>" name="txtnm" class="form-control" required></br>
		<input type="email" value="<?php echo $row['email']; ?>" name="txtmail" class="form-control" disabled></br>
		<input type="text" value="<?php echo $row['mobile']; ?>" name="txtmob" class="form-control" required></br>
		<input type="password" value="<?php echo $row['password']; ?>" name="txtpass" class="form-control" required></br>
		<input type="submit" value="Save Changes" class="btn btn-primary w-100"></br></br>
		<a href="logout.php" class="btn btn-danger btn-center w-25">Log Out</a>
	</form>
</div>
<?php
	if(isset($_POST['txtnm']))
	{
		$nm = $_POST['txtnm'];
		$mob = $_POST['txtmob'];
		$pass = $_POST['txtpass'];
		$target_dir = "images/";
		$temp = explode(".", $_FILES["fileupload"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		echo $newfilename;
		if(move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_dir.$newfilename))
		{
			$sql = "update `social_media` set name='$nm', mobile='$mob', password='$pass', profile_pic='$newfilename' where email='$oldmail'";
		}
		else
		{
			$sql = "update `social_media` set name='$nm', mobile='$mob', password='$pass' where email='$oldmail'";
		}
		if(mysqli_query($con,$sql))
		{
			header("location:home_page_1.php");
		}
	}
?>
<script>
	fileupload.onchange = evt => {
  const [file] = fileupload.files
  if (file) {
    usrimg.src = URL.createObjectURL(file)
  }
}
</script>
