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
				<h1>View Payments</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">Home</li>
					<li class="breadcrumb-item">Loans</li>
					<li class="breadcrumb-item active">Payments</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Loan Reference Number: <b><?= $_GET['ref_no'] ?> </b></h3> <br />
						<div class="d-flex justify-content-end">
							<button onclick="history.back()" class="btn btn-warning btn-sm">
								<i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
								Back
							</button>
						</div>
					</div><!-- /.card-header -->
					<div class="card-body">
						<table id="example3" class="table table-bordered table-striped">
							<?php include_once 'base/data-payments.php'; ?>
						</table>
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</section><!-- /.content -->