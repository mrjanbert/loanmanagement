<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
	header('location: ../error/404-error.php');
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
						<h2 class="card-title">Loan Reference Number: <b><?= $_GET['ref_no'] ?> </b></h2>
						<div class="d-flex justify-content-end">
							<button onclick="history.back()" class="btn btn-warning btn-sm">
								<i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
								Back
							</button>
						</div>
						<div class="row">
							<?php
							$ref_no = $_GET['ref_no'];
							$sql = $conn->query("SELECT t.borrower_id, t.comaker_id, t.amount, t.monthly, t.loan_term, t.loan_date, concat(b.firstName,' ',b.lastName) as borrower_name, concat(c.firstName,' ',c.lastName) as comaker_name FROM ((tbl_transaction t INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id) WHERE ref_no = '$ref_no'");
							$row = $sql->fetch_assoc();
							?>
							<div class="col-md-3">
								<h3 class="card-title">Name: </h3>
							</div>
							<div class="col-md-9">
								<b><?= strtoupper($row['borrower_name']) ?></b>
							</div>
							<div class="col-md-3">
								<h3 class="card-title">Loan Amount: </h3>
							</div>
							<div class="col-md-9">
								<b><?= number_format($row['amount'], 2); ?></b>
							</div>
							<div class="col-md-3">
								<h3 class="card-title">Monthly Amortization: </h3>
							</div>
							<div class="col-md-9">
								<b><?= number_format($row['monthly'], 2); ?></b>
							</div>
							<div class="col-md-3">
								<h3 class="card-title">Interest Rate: </h3>
							</div>
							<div class="col-md-9">
								<b><?= 1 . '%'; ?></b>
							</div>
							<div class="col-md-3">
								<h3 class="card-title">Term: </h3>
							</div>
							<div class="col-md-9">
								<b><?= $row['loan_term']; ?> &nbsp;Month/s</b>
							</div>
							<div class="col-md-3">
								<h3 class="card-title">Loan Date: </h3>
							</div>
							<div class="col-md-9">
								<b><?= date("F j, Y", strtotime($row['loan_date'])) ?></b>
							</div>
							<?php if ($row['borrower_id'] == $row['comaker_id']) { ?>
								<div class="col-md-3">
									<h3 class="card-title">Co-maker: </h3>
								</div>
								<div class="col-md-9">
								</div>
							<?php } else { ?>
								<div class="col-md-3">
									<h3 class="card-title">Co-maker: </h3>
								</div>
								<div class="col-md-9">
									<b><?= strtoupper($row['comaker_name']) ?></b>
								</div>
							<?php } ?>
						</div>
					</div>
					<!-- /.
					</div><!-- /.card-header -->
					<div class="card-body">
						<table id="example2" class="table table-bordered table-striped">
							<?php include_once 'base/data-payments.php'; ?>
						</table>
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</section><!-- /.content -->