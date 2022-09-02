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
				<button onclick="history.back()" class="btn btn-warning btn-sm mr-2">
					<i class="fas fa-arrow-alt-circle-left"></i>
					Back
				</button>
				<a href="javascrript:void(0)" onclick="window.print()" class="btn btn-success btn-sm">
					<i class="fa fa-print mr-1"></i>Print
				</a>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">Home</li>
					<li class="breadcrumb-item">Loans</li>
					<li class="breadcrumb-item active">Grace Period</li>
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
					<?php
					$ref_no = $_GET['ref_no'];
					$query = $conn->query("SELECT t.*, concat(c.firstName,' ',c.lastName) AS name, b.membership, concat(b.firstName,' ',b.middleName,' ',b.lastName) as borrower_name FROM tbl_transaction t INNER JOIN tbl_borrowers b ON b.user_id = t.borrower_id INNER JOIN tbl_comakers c ON  c.user_id = t.comaker_id WHERE ref_no = $ref_no");
					while ($row = $query->fetch_assoc()) :
						$borrower_id = $row['borrower_id'];
						$comaker_id = $row['comaker_id'];
						$comaker_name = $row['name'];
						$borrower_name = $row['borrower_name'];
						$membership = $row['membership'];
						$amount = $row['amount'];
						$months = $row['loan_term'];
						$interest = $row['interest'];
						$total_interest = $row['total_interest'];
						$monthly = $row['monthly'];
						$balance = $row['balance'];
						$principal = $row['principal'];
						$loan_date = strtotime($row['loan_date']);

						$interest_rate = 1; //fixed interest_rate

						if ($membership == 1) :
							$share_capital = 0.01 * $amount; 	//fixed capital for members only
							$service_charge = 0.01 * $amount; //fixed service charge
							$notarial_fee = 100; 	//fixed notarial fee

							$total_less = $share_capital + $service_charge + $notarial_fee;
							$net = $amount - ($share_capital + $service_charge + $notarial_fee);
						elseif ($membership == 0) :
							$service_charge = 0.01 * $amount; //fixed service charge
							$notarial_fee = 100; 	//fixed notarial fee

							$total_less = $service_charge + $notarial_fee;
							$net = $amount - $total_less;
						endif;
					?>
						<div class="card-header">
							<div class="row">
								<div class="col-sm-12">
									<h2 class="text-center mb-4">Equal Amortization with Grace Period</h2>
								</div>
								<div class="col-md-3">
									<h3 class="card-title">Name: </h3>
								</div>
								<div class="col-md-9">
									<b><?php echo $borrower_name; ?></b>
								</div>
								<div class="col-md-3">
									<h3 class="card-title">Loan Amount: </h3>
								</div>
								<div class="col-md-9">
									<b><?php echo number_format($amount, 2); ?></b>
								</div>
								<div class="col-md-3">
									<h3 class="card-title">Monthly Amortization: </h3>
								</div>
								<div class="col-md-9">
									<b><?php echo number_format($monthly, 2); ?></b>
								</div>
								<div class="col-md-3">
									<h3 class="card-title">15th / 30th: </h3>
								</div>
								<div class="col-md-9">
									<b><?php echo number_format($monthly / 2, 2); ?></b>
								</div>
								<div class="col-md-3">
									<h3 class="card-title">Interest Rate: </h3>
								</div>
								<div class="col-md-9">
									<b><?php echo $interest_rate . '%'; ?></b>
								</div>
								<div class="col-md-3">
									<h3 class="card-title">Term: </h3>
								</div>
								<div class="col-md-9">
									<b><?php echo $months; ?> &nbsp;Months</b>
								</div>
								<div class="col-md-3">
									<h3 class="card-title">Loan Date: </h3>
								</div>
								<div class="col-md-9">
									<b><?php echo date('F j, Y', $loan_date); ?></b>
								</div>
								<?php if ($borrower_id == $comaker_id) : ?>
									<div class="col-md-3">
										<h3 class="card-title">Membership Status:</h3>
									</div>
									<div class="col-md-9">
										<b class="text-primary">Member</b>
									</div>
								<?php else : ?>
									<div class="col-md-3">
										<h3 class="card-title">Co-maker: </h3>
									</div>
									<div class="col-md-9">
										<p><b><?= $comaker_name; ?> </b></p>
									</div>
								<?php endif ?>
							</div>
						</div><!-- /.card-header -->
						<div class="card-body">
							<table id="example2" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="20%" class="text-center">Amortization Period</th>
										<th class="text-center">Principal</th>
										<th class="text-center">Interest</th>
										<th class="text-center">Total</th>
										<th class="text-center">Balance</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<b><?php echo date('F j, Y', $loan_date); ?></b>
										</td>
										<td align="right">
											<b><?php echo number_format($amount, 2); ?></b>
										</td>
										<td align="right">
											<b><?php echo number_format($total_interest, 2); ?></b>
										</td>
										<td align="right">
											<b><?php echo number_format($balance, 2); ?></b>
										</td>
										<td align="right">
											<b><?php echo number_format($balance, 2); ?>
										</td>
									</tr>

									<?php
									for ($m = 1 + date('n', $loan_date); $m < 1 + (date('n', $loan_date) + $months); ++$m) { ?>
										<tr>
											<td>
												<?php echo date('F j, Y', mktime(0, 0, 0, $m, date('j', $loan_date), date("Y"))) ?>
											</td>
											<td align="right">
												<?php echo number_format($principal, 2); ?>
											</td>
											<td align="right">
												<?php echo number_format($interest, 2); ?>
											</td>
											<td align="right">
												<?php echo number_format($monthly, 2); ?>
											</td>
											<?php
											do {
												if ($balance < $monthly) {
													$principal = $balance;
												}
												$balance = $balance - $principal - $interest;
												if ($balance < 0) {
													$balance = 0;
												}
											?>
												<td align="right">
													<?php echo number_format($balance, 2); ?>
												</td>
											<?php
											} while ($balance < 0)
											?>
										</tr>
									<?php } ?>
								</tbody>
							</table>

							<?php
							if ($membership == 1) :
							?>
								<div class="row mt-3">
									<div class="col-md-4">
										<strong>Principal:</strong>
									</div>
									<div class="col-md-2 text-right">
										&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($amount, 2) ?>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Share Capital </strong><i> (for members only)</i> 1% <strong>: </strong>
									</div>
									<div class="col-md-2">
										&nbsp;&nbsp;&nbsp;<?php echo number_format($share_capital, 2) ?>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Service Charge </strong>1%<strong>: </strong>
									</div>
									<div class="col-md-2">
										&nbsp;&nbsp;&nbsp;<?php echo number_format($service_charge, 2) ?>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Notarial fee: </strong>
									</div>
									<div class="col-md-2">
										<p class="d-flex justify-content-between" style="border-bottom: 3px solid;">
											<span>&nbsp;&nbsp;&nbsp;<?php echo number_format($notarial_fee, 2) ?></span>
											<span><?php echo number_format($total_less, 2) ?></span>
										</p>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
									</div>
									<div class="col-md-2 text-right pt-0">
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Net Proceeds: </strong>
									</div>
									<div class="col-md-2 text-right">
										<p style="border-bottom: 3px double;"><b><?php echo number_format($net, 2) ?></b></p>
									</div>
									<div class="col-md-6">
									</div>
								</div>
							<?php
							elseif ($membership == 0) :
							?>
								<div class="row mt-3">
									<div class="col-md-4">
										<strong>Principal:</strong>
									</div>
									<div class="col-md-2 text-right">
										&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($amount, 2) ?>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Service Charge </strong>1%<strong>: </strong>
									</div>
									<div class="col-md-2">
										&nbsp;&nbsp;&nbsp;<?php echo number_format($service_charge, 2) ?>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Notarial fee: </strong>
									</div>
									<div class="col-md-2">
										<p class="d-flex justify-content-between" style="border-bottom: 3px solid;">
											<span>&nbsp;&nbsp;&nbsp;<?php echo number_format($notarial_fee, 2) ?></span>
											<span><?php echo number_format($total_less, 2) ?></span>
										</p>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
									</div>
									<div class="col-md-2 text-right pt-0">
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Net Proceeds: </strong>
									</div>
									<div class="col-md-2 text-right">
										<p style="border-bottom: 3px double;"><b><?php echo number_format($net, 2) ?></b></p>
									</div>
									<div class="col-md-6">
									</div>
								</div>
							<?php endif; ?>


							<div class="row">

								<div class="col-md-6">
								</div>
								<div class="col-md-1">
									<p>Borrower:</p>
								</div>
								<div class="col-md-5">
									<p style="border-bottom: 1px solid;" class="text-center text-bold mb-0"><?= strtoupper($borrower_name) ?></p>
									<p class="text-center p-0">Sginature over printed name</p>
								</div>
							</div>
						</div><!-- /.card-body -->
					<?php endwhile; ?>
				</div><!-- /.card -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</section><!-- /.content -->