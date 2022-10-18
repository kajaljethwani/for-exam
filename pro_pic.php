<html>
	<head> 
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js"></script>
	</head>
<form action="pro_pic.php" method="POST" enctype="multipart/form-data">
	<input type="text" class="form-control" name="txtroll" placeholder="Enter roll no."></br>
	<input type="text" class="form-control" name="txtnm" placeholder="Enter name."></br>
	<input type="file" class="form-control" name="fileupload1" id="imgInp" accept=".png.jpg.jpeg"></br>
	<img src="" id="blah" alt="select image" height="150" width="150"></br>
	<input type="submit" value="save">
</form>

<?php
	$con=mysqli_connect("localhost","root","","kajal_1");
	if(isset($_POST['txtroll']))
	{
		if($con)	
		{
			$roll=$_POST['txtroll'];
			$nm=$_POST['txtnm'];
			$target_dir="images/";
			$name=rand(150,480000);
			$extension=pathinfo($_FILES["fileupload1"]["name"],PATHINFO_EXTENSION);
			$fnm=$name.".".$extension;
			move_uploaded_file($_FILES["fileupload1"]["tmp_name"],$target_dir.$name.".".$extension);
			$sql="INSERT INTO `profile_pic`(`roll`,`name`,`profile_pic`)VALUES('$roll','$nm','$fnm')";
			$res=mysqli_query($con,$sql);
		}
	}	
?>
<script>
	imgInp.onchange = evt =>
	{
		const[file]=imgInp.files
		if(file)
		{
			blah.src= URL.createObjectURL(file)
		}
	}
</script>
<table class="table table-bordered text-center"width="100%">
	<div class="container mt-3">
					<tr>
						<th>id
						<th>Roll No
						<th>Name
						<th>profile_pic
						<th>action
					<?php
					
						
						$sql="SELECT * FROM `profile_pic`";
						$res=mysqli_query($con,$sql);
						$i=1;
						while($row=mysqli_fetch_assoc($res))
						{
					?>	
					<tr>
							<td><?php echo $i; ?>
							<td><?php echo $row['roll']; ?>
							<td><?php echo $row['name']; ?>
						    <td><img height="100" width="100" src="<?php echo "images/".$row['profile_pic'];?>">
			
							<td> <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
							
					<?php 
							$i++;
						}
					?>
				
	</div>			
</html>