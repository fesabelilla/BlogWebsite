<?php require_once("include/db.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/Sessions.php"); ?>


<!DOCTYPE html>
<html>
<head>
	  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
  <title>Posts</title>
</head> 
<body>

<div style="height: 10px; background:#27aae1;"></div>
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
		<h3><i class="fas fa-blog" style="color:white;"></i>Blog Posts</h3>
		</div>

		<div class="col-lg-3 mb-2">
			<a href="AddNewPost.php" class="btn btn-primary btn-block">
				<i class="fas fa-edit"></i> Add New Post
			</a>
		</div>

		<div class="col-lg-3 mb-2">
			<a href="categories.php" class="btn btn-info btn-block">
				<i class="fas fa-folder-plus"></i> Add New Categories
			</a>
		</div>

		<div class="col-lg-3 mb-2">
			<a href="Admins.php" class="btn btn-warning btn-block">
				<i class="fas fa-user-plus"></i> Add New Admin
			</a>
		</div>

		<div class="col-lg-3 mb-2">
			<a href="Comments.php" class="btn btn-success btn-block">
				<i class="fas fa-check"></i> Approve Comments
			</a>
		</div>




	</div>
</div>
</header>
<!--HEADER  -->


<!-- Main Area Start -->
<div class="container py-2 mb-4">
	<div class="row">
		<div class="col-lg-12">
			<table>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Category</th>
					<th>Date&Time</th>
					<th>Author</th>
					<th>Banner</th>
					<th>Comments</th>
					<th>Action</th>
					<th>Live Preview</th>			
				</tr>

				<?php  
					global $connectionDB;

					$sql = "select * from posts";
					$stmt = $connectionDB->query($sql);

					while ($DataRows = $stmt->fetch()) {
						$id = $DataRows["id"];
						$dateTime = $DataRows["datetime"];
						$postTitle = $DataRows["title"];
						$category = $DataRows["category"];
						$admin = $DataRows["author"];
						$image = $DataRows["image"];
						$postText = $DataRows["post"];

				?>
				<tr>
					<td>#</td>
					<td><?php echo $postTitle ; ?></td>
					<td><?php echo $category ;?></td>
					<td><?php echo $dateTime ; ?></td>
					<td><?php echo $admin ;?></td>
					<td><?php echo $image ; ?></td>
					<td>Comments</td>
					<td>Action</td>
					<td>Live Preview</td>
				</tr>

				<?php } ?>


			</table>
		</div>
	</div>
</div>





<!-- Main Area End -->

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
<div style="height: 10px; background:#27aae1;"></div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<!-- for date -->

<script >
	$('#year').text(new Date().getFullYear());
</script>

</body>
</html>