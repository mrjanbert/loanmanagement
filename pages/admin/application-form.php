<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
	header('location: http://localhost/loanmanagement/pages/err/404-error.php');
	exit();
};
?>
<?php if (isset($_SESSION['role_name']) && (trim($_SESSION['role_name']) != (null))) : ?>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<button onclick="history.back()" class="btn btn-warning btn-sm">
						<i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
						Back
					</button> &nbsp;&nbsp;
					<button onclick="window.print()" class="btn btn-success btn-sm">
						<i class="fa fa-print"></i>&nbsp;Print
					</button>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">Home</li>
						<li class="breadcrumb-item">Loans</li>
						<li class="breadcrumb-item active">Application Form</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row d-flex">
				<div class="col-md-12">
					<div class="card">
						<img src="../../assets/images/Header.png" style="width: 100%; height: 5%;" alt="NMSC Header.php">
						<div class="card-body p-0">
							<h2 class="text-center" style="font-family: Times New Roman, Times, serif; font-weight: bold;">NMSCST CREDIT COOPERATIVE</h2>
							<div class="col-md-12" style="font-family: Courier New, monospace;">
								<h2 class="text-center" style=" font-weight: bold;">APPLICATION FOR LOAN</h2>
								&nbsp;&nbsp;&nbsp;<button role="button" style="font-weight: bold;">Customer's Copy</button>
							</div>
							<div class="col-md-12">

							</div>
						</div>
					</div><!-- /.card -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</section><!-- /.content -->

<?php endif ?>