<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
	header('location: http://localhost/loanmanagement/pages/err/404-error.php');
	exit();
};
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<button onclick="history.back()" class="btn btn-warning">
					<i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
					Back
				</button> &nbsp;&nbsp;
				<button onclick="window.print()" class="btn btn-success">
					<i class="fa fa-print"></i>&nbsp;Print
				</button>
				<a href="app-form.php?ref_no=<?= $_GET['ref_no'] ?>">pdf</a>
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
				<div class="card d-flex align-items-center m-0 p-0">
					<img src="../../assets/images/application-form-for-loan.jpg" style="width: 100%;" align="center" alt="NMSC Header.php">
				</div><!-- /.card -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</section><!-- /.content -->