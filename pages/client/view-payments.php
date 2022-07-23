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


<?php
// $ref_no = $_GET['ref_no'];
// $query = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = $ref_no");
// $data = $query->fetch_array();
// $amount = $data['amount'];

// // $penalty = $monthly * ($penalty/100);
// $interest = 0.01;
// $total_interest = ($amount * ($interest)) * $months;
// $monthly = ($amount + $total_interest) / $months;

// $share_capital = 0.01 * $amount; 	//fixed capital for members only
// $service_charge = 0.01 * $amount; //fixed service charge
// $notarial_fee = 100; 	//fixed notarial fee

// $total_less = $share_capital + $service_charge + $notarial_fee;
// $net = $amount - ($share_capital + $service_charge + $notarial_fee);
?>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Name: <b><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?> </b></h3> <br />
						<h3 class="card-title">Loan Amount: </h3><br />
						<h3 class="card-title">Monthly Amortization: </h3><br />
						<h3 class="card-title">Interest: </h3><br />
						<h3 class="card-title">Term: </h3><br />
						<h3 class="card-title">Loan Date: </h3><br />
						<h3 class="card-title">Co-maker: </h3><br />
					</div><!-- /.card-header -->
					<div class="card-body">
						<div class="d-flex justify-content-end">
							<button onclick="history.back()" class="btn btn-warning btn-sm">
								<i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
								Back
							</button>
						</div>
						<table id="example2" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="15%" class="text-center">Date</th>
									<th width="15%" class="text-center">Principal</th>
									<th class="text-center">Interest</th>
									<th class="text-center">Penalty</th>
									<th class="text-center">OR #</th>
									<th class="text-center">Payment</th>
									<th class="text-center">Balance</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>November 1, 2022</td>
									<td>10000</td>
									<td>123456</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>December 1, 2022</td>
									<td>20000</td>
									<td>12345</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</section><!-- /.content -->