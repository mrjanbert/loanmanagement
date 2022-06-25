<?php
	if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
	header('location: http://localhost/loan-management/application/pages/error-pages/403-error.php');
	exit();
	};
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Payments</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
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
						<h3 class="card-title">Payments List</h3>
					</div><!-- /.card-header -->
					<div class="card-body">
						<table id="example2" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No.</th>
									<th>Loan Reference No.</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>123456</td>
									<td class="text-center">
                                        <a href="index.php?page=view-payments" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
								</tr>
								<tr width="10%">
									<td>2</td>
									<td>12345</td>
									<td class="text-center">
                                        <a href="index.php?page=view-payments" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
								</tr>
							</tbody>
						</table>
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</section><!-- /.content -->