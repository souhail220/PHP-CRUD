<!DOCTYPE html />
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PHP ADVANCED CRUD</title>
	<link rel="stylesheet" href="">

	<!-- bootstrap css link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

	<!-- font awesome cdn -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="styles.css">

</head>
<body>
	
	<h1 class="bg-dark text-light text-center py-2">PHP Advanced CRUD</h1>

	<div class="container my-4">

		<!-- form Modal -->
		<?php include("components/form.php"); ?>
		<?php include("components/profile.php") ?>

		<!-- input and button section -->
		<div class="row">
			<div class="col-10">
				<div class="input-group mb-3">
  					<button class="input-group-text bg-dark">²
							<i class="fas fa-search text-light"></i>
					</button>
  					<input type="text" class="form-control" placeholder="Search user..." aria-label="Search" aria-describedby="basic-addon1">
				</div>
			</div>
			<div class="col-2">
				<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#userModal">
  					Add new User
				</button>
			</div>
		</div>

		<!-- Table -->
		<?php include("components/table.php"); ?>

		<!-- Pagination -->
		<nav class="mt-4" aria-label="Page navigation example" id="pagination">
  			
		</nav>
		<input type="hidden" value="1" name="currentPage" id="currentPage">
	</div>
	

	<!-- jquery cdn -->
	<script 
		src="https://code.jquery.com/jquery-3.7.1.min.js" 
		integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
		crossorigin="anonymous"
	></script>

	<!-- bootstrap js link -->
	<script 
		src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
		integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" 
		crossorigin="anonymous"
	></script>
	<script 
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
		integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" 
		crossorigin="anonymous"
	></script>

	<!-- js file -->
	<script src="Js/script.js"></script>
</body>
</html>