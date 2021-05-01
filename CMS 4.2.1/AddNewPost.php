<?php require_once("include/db.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/Sessions.php"); ?>

<?php 

	 if(isset($_POST["Submit"])){

	 	$postTitle = $_POST["postTitle"];
	 	$category = $_POST["category"];
	 	$image = $_FILES["Image"]["name"];
	 	$target = "uploads/".basename($_FILES["Image"]["name"]);
	 	$postText = $_POST["postDescription"];
	 	$admin = "Zahid";

	 	date_default_timezone_set("Asia/Dhaka");
		$currentTime = time();
		$DateTime = strftime("%B-%d-%Y %H:%M:%S",$currentTime);
		//echo $dateTime ;
	 	
 	if(empty($postTitle)){
 		$_SESSION["ErrorMessage"] = "Title can't be empty";
 		Redirect_to("AddNewPost.php");
 	}
 	elseif (strlen($postTitle) < 5 ) {
 		$_SESSION["ErrorMessage"] = " Post Title should be greater then 5 characters ";
 		Redirect_to("AddNewPost.php");
 	}
 	elseif (strlen($postText) > 1499 ) {
 		$_SESSION["ErrorMessage"] = " Post characters should be less then 1499 characters ";
 		Redirect_to("AddNewPost.php");
 	}
 	else{
 		// query insert in db post table
 		global $connectionDB;
 		$sql = "insert into posts(datetime,title,category,author,image,post)";
 		$sql .= "values(:dateTime,:postTitle,:categoryName,:adminName,:imageName,:postDescription)";

 		// -> pdo obj notation [ PHP data obj]
 		$stmt = $connectionDB->prepare($sql);
 		$stmt->bindValue(':dateTime', $DateTime);
 		$stmt->bindValue(':postTitle',$postTitle);
 		$stmt->bindValue(':categoryName',$category);
 		$stmt->bindValue(':adminName', $admin);
 		$stmt->bindValue(':imageName',$image);
 		$stmt->bindValue(':postDescription',$postText);
 		//$stmt->bindValue(':',$);
 		$execute = $stmt->execute();
 		//move_uploaded_file($_FILES["image"]["tmp_name"],$target);

 		if($execute){
 			$_SESSION["SuccessMessage"] = "Post added  
 			Id : ".$connectionDB->lastInsertId() ." Successfully";
 			Redirect_to("AddNewPost.php");
 		}else{
 			$_SESSION["ErrorMessage"] = "Something went wrong. Try again!";
 			Redirect_to("AddNewPost.php");
 		}

 	}
 	
 	/*if(!empty($category)){
 		$_SESSION["SuccessMessage"] = "Done";
 	}*/
} // ending of submit btn 

 ?>

<!DOCTYPE html>
<html>
<head>
	  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
  <title>Categories</title>
</head> 
<body>

<div style="height: 10px; background: #27aae1;"></div>

<!-- Nav-bar start -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

	<div class="container">

		<a href="#" class="navbar-brand"> mzf.com </a>

		<button class="navbar-toggler" data-toggle="collapse" data-target = "#navbarcollapseCMS">

			<span class="navbar-toggler-icon"></span>

		</button>

		<div class="collapse navbar-collapse" id="navbarcollapseCMS">

		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a href="myProfile.php" class="nav-link"> <i class="fas fa-user text-success"></i> My Profile</a>
			</li>

			<li class="nav-item">
				<a href="dashboard.php" class="nav-link">Dashboard</a>
			</li>

			<li class="nav-item">
				<a href="categories.php" class="nav-link">Categories</a>
			</li>

			<li class="nav-item">
				<a href="manageAdmin.php" class="nav-link">Manage Admins</a>
			</li>

			<li class="nav-item">
				<a href="comments.php" class="nav-link">Comments</a>
			</li>

			<li class="nav-item">
				<a href="blog.php?page=1" class="nav-link">Live Blog</a>
			</li>

		</ul>

		<ul class="navbar-nav ml-auto">
			<li class="nav-item"><a href="logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a></li>			
		</ul>

		</div>

	</div>

</nav>
<div style="height: 10px; background:#27aae1;"></div>

<!-- Nav-bar end-->

<!--HEADER -->
<header class="bg-dark text-white py-3">
<div class="container">
	<div class="row">
		<div class="col-md-12">	
		<h3><i class="fas fa-edit" style="color:#27aae1;"></i>Add New Post</h3>
		</div>
	</div>
</div>
</header>



<!-- -->

<!-- Main area -->

<section class="container py-2 mb-4">
	<div class="row" >
		<div class="offset-lg-1 col-lg-10" style="min-height:400px;">

			<?php  
				echo ErrorMessage();
				echo SuccessMessage();
			?>

			<form class="" action="AddNewPost.php" method="post" enctype="multipart/form-data" >
					<div class="card bg-secondary text-light mb-3">
						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="title" style="color:white;">Post Title : </label>
								<input class="form-control" type="text" name="postTitle" id="title" placeholder="Type title here ">
							</div>

							<div class="card-body bg-dark">
							<div class="form-group">
								<label for="categoryTitle" style="color:white;">Chose Category : </label>

							<select class="form-control" id = "CategoryTitle" name="category" >
								<?php 
									//fetching all the category from category table
									global $connectionDB;	
									$sql = "select id,title from category";	

									$stmt = $connectionDB->query($sql);			

									while ($dataRows = $stmt->fetch()) {
												$id = $dataRows["id"];
												$categoryName = $dataRows["title"];

								 ?>
								 <option><?php echo $categoryName;  ?> </option>

								 <?php }  ?>


							</select>
							</div>

							<div class="form-group mb-1">

								<div class="custom-file">
									<input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
									<label for="imageSelect" class="custom-file-label">Select Image</label>
								</div>
								
							</div>

							<div class="form-group">
								<label for="Post"> <span class="FieldInfo"> Post : </span></label>
								<textarea class="form-control" id="Post" name="postDescription" rows="8" cols="80"></textarea>
							</div>


							<div class="row">
								<div class="col-lg-6 mb-2">
									<a href = "dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back To Dashboard </a>
									
								</div>
								<div class="col-lg-6 mb-2">
									<button type="submit" name="Submit"class="btn btn-success btn-block">
									<i class="fas fa-check"></i>Publish
									</button>
								</div>
								
							</div>

						</div>

					</div>

			</form>
			
		</div>
		
	</div>
	
</section>


<!-- End Main area-->


<!-- FOOTER -->
<footer class="bg-dark text-white">
	<div class="container">
		<div class="row">
			<div class="col">
				<p class="lead text-center">Theme By | MZF | <span id="year"></span> &copy; --All right reserved</p>

			</div>
			
		</div>
		
	</div>

</footer>
<div style="height: 10px; background: #27aae1;"></div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<!-- for date -->

<script >
	$('#year').text(new Date().getFullYear());
</script>

</body>
</html>