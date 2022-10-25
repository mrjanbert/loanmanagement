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
        <h1>List of Payments</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">Payments List</li>
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
            <h2 class="card-title">Payments List</h2>
            <div class="d-flex justify-content-end">
              <button onclick="history.back()" class="btn btn-warning btn-sm">
                <i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
                Back
              </button>
            </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <table id="example3" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th>Reference Number</th>
                  <th>Amount</th>
                  <th>Loan Term</th>
                  <th>View</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                $sql = "SELECT t.*, s.* FROM tbl_transaction t INNER JOIN tbl_status s on s.ref_no = t.ref_no WHERE s.status_cashier = '2' AND t.borrower_id = " . $_SESSION['user_id'];
                $results = mysqli_query($conn, $sql);
                while ($row = $results->fetch_assoc()) {
                  $ref_no = $row['ref_no'];
                  $amount = $row['amount'];
                  $loan_term = $row['loan_term'];
                ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $ref_no ?></td>
                    <td><?= number_format($amount, 2) ?></td>
                    <td><?= $loan_term ?> Month/s</td>
                    <td>
                      <a href="index.php?page=view-payments&ref_no=<?= $row['ref_no'] ?>" class="my-1 btn btn-warning text-white btn-xs" title="View Payments" data-toggle="tooltip" data-placement="top">
                        View Payments
                      </a>
                    </td>
                  </tr>

                <?php } ?>
              </tbody>

            </table>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section><!-- /.content -->