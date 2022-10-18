<html>
	<head> 
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />
	</head>
<form action="image_1.php" method="POST" enctype="multipart/form-data">
	<input type="file" class="form-control" name="fileupload1" id="imgInp" accept=".png.jpg.jpeg"></br>
	
	<input type="submit" class="btn btn-primary form-control text-center"  value="save">
</form>

<?php
	$con=mysqli_connect("localhost","root","","kajal_1");
	if(isset($_FILES['fileupload1']))
	{
			$target_dir="images/";
			$target_file=$target_dir.basename($_FILES["fileupload1"]["name"]);
			$temp=explode(".",$_FILES["fileupload1"]["name"]);
			$newfilename=rand(150,480000).'.'.end($temp);
			move_uploaded_file($_FILES["fileupload1"]["tmp_name"],$target_dir.$newfilename);
			$sql="INSERT INTO `image`(`image`) VALUES ('$newfilename')";
			
			$res=mysqli_query($con,$sql);
		
	}
?>

<table class="table table-bordered text-center">
	<tr>
		
		<th>image
		<?php
		
			$sql="SELECT * FROM `image`";
			$res=mysqli_query($con,$sql);
	
			while($row=mysqli_fetch_assoc($res))
			{
		?>	
	<tr>
		
		<td><img src="<?php echo "images/".$row['image'];?>" height="50" width="50">
		
		 
	    <?php 
		
			}
		?>
</table>	 