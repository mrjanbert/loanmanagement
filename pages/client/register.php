<?php
session_start();

if (isset($_SESSION['user_id'])) {
	header('location: ./index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<title>Register :: NMSCST Loan Management System</title>
	<link rel="icon" type="image/x-icon" href="https://www.nmsc.edu.ph/application/themes/nmsc/favicon.ico">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
	<!-- Google Fonts Roboto -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

	<!-- Theme style -->
	<link rel="stylesheet" href="../../assets/dist/css/adminlte.min.css">

	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="../../assets/plugins/sweetalert2/sweetalert2.min.css">
	<script src="../../assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

	<!-- MDB -->
	<link rel="stylesheet" href="../../components/hometemplate/css/mdb.min.css" />
	<!-- Custom styles -->
	<link rel="stylesheet" href="../../components/hometemplate/css/scrollbarhidden.css" />

</head>

<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block">
		<div class="container-fluid">
			<!-- Navbar brand -->
			<a class="navbar-brand nav-link" target="_blank" href="#">
				<strong>LMS</strong>
			</a>
			<button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseNavbar" aria-controls="collapseNavbar" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="collapseNavbar">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link text-white" href="../../">Home</a>
					</li>
				</ul>

				<ul class="navbar-nav d-flex flex-row">
					<li class="nav-item me-3 me-lg-0">
						<a class="nav-link text-white" href="https://github.com/mrjanbert/loanmanagement" rel="nofollow" target="_blank">
							<i class="fab fa-github"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Navbar -->

	<!--Main layout-->
	<main>
		<!-- Toast Notification -->
		<?php
		if (isset($_SESSION['status'])) {
			$status = $_SESSION['status'];
			echo "<span>$status</span>";
		}
		?>
		<!-- end of toast -->
		<div class="container">
			<!--Section: Content-->
			<section class="vh-100">
				<div class="container h-100">
					<div class="row d-flex justify-content-center align-items-center h-100">
						<div class="col-lg-12 col-xl-11">
							<div class="card text-black">
								<div class="card-body p-md-5">
									<div class="row justify-content-center">
										<div class="col-md-10 col-lg-6 col-xl-7 order-2 order-lg-1">

											<p class="text-center h1 fw-bold mb-3 mx-1 mx-md-4 mt-4">Sign up</p>
											<p class="text-center h5 mb-5">Create your account</p>

											<form class="mx-1 mx-md-4" action="../../config/create-userclient.php" method="POST" enctype="multipart/form-data">

												<div class="d-flex flex-row align-items-center mb-4">
													<i class="fas fa-id-badge fa-lg me-3 fa-fw"></i>
													<div class="form-outline flex-fill mr-1">
														<input type="text" name="accountNumber" class="form-control" required />
														<label class="form-label">ID Number</label>
													</div>
													<div class="form-outline flex-fill mb-0">
														<input type="text" name="username" class="form-control" required />
														<label class="form-label">Username</labe l>
													</div>
												</div>
												<div class="d-flex flex-row align-items-center mb-4">
													<i class="fas fa-user fa-lg me-3 fa-fw"></i>
													<div class="form-outline flex-fill mr-1">
														<input type="text" name="firstName" class="form-control" required />
														<label class="form-label">First Name</label>
													</div>
													<div class="form-outline flex-fill mr-1">
														<input type="text" name="middleName" class="form-control" />
														<label class="form-label">Middle Name</label>
													</div>
													<div class="form-outline flex-fill">
														<input type="text" name="lastName" class="form-control" required />
														<label class="form-label">Last Name</label>
													</div>
												</div>

												<div class="d-flex flex-row align-items-center mb-4">
													<i class="fas fa-address-card fa-lg me-3 fa-fw"></i>
													<div class="form-outline flex-fill mb-0">
														<input type="text" name="address" class="form-control" required />
														<label class="form-label">Address</label>
													</div>
												</div>

												<div class="d-flex flex-row align-items-center mb-4">
													<i class="fas fa-birthday-cake fa-lg me-3 fa-fw"></i>
													<div class="form-outline flex-fill mr-4">
														<input type="date" name="birthDate" class="form-control" required />
													</div>
													<i class="fas fa-mobile-alt fa-lg me-2 fa-fw"></i>
													<div class="form-outline flex-fill">
														<input type="number" name="contactNumber" maxlength="10" placeholder="Ex. 9123456789" class="form-control" required />
														<label class="form-label">Mobile Number</label>
													</div>
												</div>

												<div class="d-flex flex-row align-items-center mb-0">
													<i class="fas fa-image fa-lg me-3 fa-fw"></i>
													<div class="form-outline flex-fill mb-0">
														<input type="file" name="profilePhoto" class="form-control" required />
													</div>
												</div>
												<div class="d-flex flex-row align-items-center mb-4">
													<i class="fas fa-lg me-3 fa-fw"></i>
													<div class="small text-muted mt-2">Upload your Profile Picture</div>
												</div>

												<div class="d-flex flex-row align-items-center mb-4">
													<i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
													<div class="form-outline flex-fill mb-0 mr-4">
														<input type="email" name="email" class="form-control" required />
														<label class="form-label">Email</labe l>
													</div>
													<i class="fas fa-lock fa-lg me-2 fa-fw"></i>
													<div class="form-outline flex-fill mb-0">
														<input type="password" name="password" class="form-control" required />
														<label class="form-label">Password</label>
													</div>
												</div>

												<div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
													<button class="btn btn-primary" type="submit" value="submit" name="submit">Register</button>
												</div>
											</form>
											<div class="text-lg-start">
												<p class="text-center fw-bold mt-1 pt-1 mb-0">Already have an account? <a href="login.php" class="link-danger">Login</a></p>
											</div>
										</div>

										<div class="col-md-10 col-lg-6 col-xl-5 d-flex align-items-center order-1 order-lg-2">
											<img src="../../components/hometemplate/img/signup.webp" class="img-fluid" alt="Sample image">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--Section: Content-->
		</div>
	</main>

	<!-- unset toast notification to avoid popup every load -->
	<?php unset($_SESSION["status"]); ?>

	<!-- jQuery -->
	<script src="../../assets/plugins/jquery/jquery.min.js"></script>
	<!-- MDB -->
	<script type="text/javascript" src="../../components/hometemplate/js/mdb.min.js"></script>
	<!-- Custom scripts -->
	<!-- <script type="text/javascript" src="js/script.js"></script> -->
</body>

</html>