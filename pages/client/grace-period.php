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

				<?php
				$ref_no = $_GET['ref_no'];
				$status = $conn->query("SELECT * from tbl_status WHERE ref_no = $ref_no");
				while ($row = $status->fetch_assoc()) :
					$status_comaker = $row['status_comaker'];
				endwhile;
				?>
				<?php if ($status_comaker != 2) : ?>
					<div class="card">
						<?php
						$borrower_id = $_SESSION['user_id'];
						$borrower = $conn->query("SELECT * FROM tbl_borrowers WHERE user_id = $borrower_id");
						while ($row = $borrower->fetch_assoc()) {
							$borrower_membership = $row['membership'];
							$borrower_name = $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'];
						}

						$query = $conn->query("SELECT t.*, concat(c.firstName,' ',c.lastName) AS name FROM tbl_transaction t INNER JOIN tbl_comakers c ON  c.user_id = t.comaker_id WHERE t.ref_no = $ref_no");
						while ($row = $query->fetch_assoc()) :
							$comaker_id = $row['comaker_id'];
							$comaker_name = $row['name'];
							$amount = $row['amount'];
							$months = $row['loan_term'];
							$interest = $row['interest'];
							$total_interest = $row['total_interest'];
							$monthly = $row['monthly'];
							$balance = $row['balance'];
							$principal = $row['principal'];
							$loan_date = strtotime($row['loan_date']);

							$interest_rate = 1; //fixed interest_rate

							if ($borrower_membership == 1) :
								$share_capital = 0.01 * $amount; 	//fixed capital for members only
								$service_charge = 0.01 * $amount; //fixed service charge
								$notarial_fee = 100; 	//fixed notarial fee

								$total_less = $share_capital + $service_charge + $notarial_fee;
								$net = $amount - ($share_capital + $service_charge + $notarial_fee);
							elseif ($borrower_membership == 0) :
								$service_charge = 0.01 * $amount; //fixed service charge
								$notarial_fee = 100; 	//fixed notarial fee

								$total_less = $service_charge + $notarial_fee;
								$net = $amount - ($service_charge + $notarial_fee);
							endif;
						endwhile;
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
									<b><?= $borrower_name ?></b>
								</div>
								<div class="col-md-3">
									<h3 class="card-title">Loan Amount: </h3>
								</div>
								<div class="col-md-9">
									<b><?= number_format($amount, 2); ?></b>
								</div>
								<div class="col-md-3">
									<h3 class="card-title">Monthly Amortization: </h3>
								</div>
								<div class="col-md-9">
									<b><?= number_format($monthly, 2); ?></b>
								</div>
								<div class="col-md-3">
									<h3 class="card-title">15th / 30th: </h3>
								</div>
								<div class="col-md-9">
									<b><?= number_format($monthly / 2, 2); ?></b>
								</div>
								<div class="col-md-3">
									<h3 class="card-title">Interest Rate: </h3>
								</div>
								<div class="col-md-9">
									<b><?= $interest_rate . '%'; ?></b>
								</div>
								<div class="col-md-3">
									<h3 class="card-title">Term: </h3>
								</div>
								<div class="col-md-9">
									<b><?= $months; ?> &nbsp;Months</b>
								</div>
								<div class="col-md-3">
									<h3 class="card-title">Loan Date: </h3>
								</div>
								<div class="col-md-9">
									<b><?= date('F j, Y', $loan_date); ?></b>
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
											<b><?= date('F j, Y', $loan_date); ?></b>
										</td>
										<td align="right">
											<b><?= number_format($amount, 2); ?></b>
										</td>
										<td align="right">
											<b><?= number_format($total_interest, 2); ?></b>
										</td>
										<td align="right">
											<b><?= number_format($balance, 2); ?></b>
										</td>
										<td align="right">
											<b><?= number_format($balance, 2); ?>
										</td>
									</tr>

									<?php
									for ($m = 1 + date('n', $loan_date); $m < 1 + (date('n', $loan_date) + $months); ++$m) { ?>
										<tr>
											<td>
												<?= date('F j, Y', mktime(0, 0, 0, $m, date('j', $loan_date), 22)) ?>
											</td>
											<td align="right">
												<?= number_format($principal, 2); ?>
											</td>
											<td align="right">
												<?= number_format($interest, 2); ?>
											</td>
											<td align="right">
												<?= number_format($monthly, 2); ?>
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
													<?= number_format($balance, 2); ?>
												</td>
											<?php
											} while ($balance < 0)
											?>
										</tr>
									<?php } ?>
								</tbody>
							</table>

							<?php
							if ($_SESSION['membership'] == 1) :
							?>
								<div class="row mt-3">
									<div class="col-md-4">
										<strong>Principal:</strong>
									</div>
									<div class="col-md-2 text-right">
										&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($amount, 2) ?>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Share Capital </strong><i> (for members only)</i> 1% <strong>: </strong>
									</div>
									<div class="col-md-2">
										&nbsp;&nbsp;&nbsp;<?= number_format($share_capital, 2) ?>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Service Charge </strong>1%<strong>: </strong>
									</div>
									<div class="col-md-2">
										&nbsp;&nbsp;&nbsp;<?= number_format($service_charge, 2) ?>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Notarial fee: </strong>
									</div>
									<div class="col-md-2">
										<p style="border-bottom: 3px solid;">&nbsp;&nbsp;&nbsp;<?= number_format($notarial_fee, 2) ?></p>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
									</div>
									<div class="col-md-2 text-right pt-0">
										<strong> = </strong> <?= number_format($total_less, 2) ?>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Net Proceeds: </strong>
									</div>
									<div class="col-md-2 text-right">
										<p style="border-bottom: 3px double;"><b><?= number_format($net, 2) ?></b></p>
									</div>
									<div class="col-md-6">
									</div>
								</div>
							<?php
							elseif ($_SESSION['membership'] == 0) :
							?>
								<div class="row mt-3">
									<div class="col-md-4">
										<strong>Principal:</strong>
									</div>
									<div class="col-md-2 text-right">
										&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($amount, 2) ?>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Service Charge </strong>1%<strong>: </strong>
									</div>
									<div class="col-md-2">
										&nbsp;&nbsp;&nbsp;<?= number_format($service_charge, 2) ?>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Notarial fee: </strong>
									</div>
									<div class="col-md-2">
										<p style="border-bottom: 3px solid;">&nbsp;&nbsp;&nbsp;<?= number_format($notarial_fee, 2) ?></p>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
									</div>
									<div class="col-md-2 text-right pt-0">
										<strong> = </strong> <?= number_format($total_less, 2) ?>
									</div>
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<strong>Net Proceeds: </strong>
									</div>
									<div class="col-md-2 text-right">
										<p style="border-bottom: 3px double;"><b><?= number_format($net, 2) ?></b></p>
									</div>
									<div class="col-md-6">
									</div>
								</div>

							<?php endif; ?>
						</div><!-- /.card-body -->
					</div><!-- /.card -->
				<?php endif; ?>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</section><!-- /.content -->

<div class="modal fade" id="addpayment">
	<div class="modal-dialog modal-md">
		<form action="../../config/create-payment.php">
			<div class="modal-content card-outline card-primary">
				<div class="modal-header">
					<h4 class="modal-title">Add Payment</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label>Loan Reference No. <small class="text-red">*</small></label>
								<input type="text" class="form-control form-control-border" name="ref_no" value="<?php echo $_GET['ref_no'] ?>" readonly>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Payee <small class="text-red">*</small> </label>
								<select class="select2" style="width: 100%;" name="payee" data-placeholder="Choose Payee" required>
									<option></option>
									<option value="Borrower">Borrower</option>
									<option value="Co-maker">Co-maker</option>
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Payment Amount <small class="text-red">*</small></label>
								<input type="number" class="form-control form-control-border" name="payment_amount" placeholder="Enter Amount" required>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Penalty</label>
								<input type="number" class="form-control form-control-border" name="penalty" placeholder="Enter Penalty 	Amount">
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer justify-content-end">
					<button type="submit" name="submit" class="btn btn-primary">
						Save
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						Cancel
					</button>
				</div>
			</div>
		</form><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>