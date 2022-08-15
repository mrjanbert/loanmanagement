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
          <h1>Payments</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Payments</li>
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
              <table id="example3" class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Borrower</th>
                    <th class="text-center">Reference Number</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Loan Term</th>
                    <th class="text-center">View</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  $sql = "SELECT t.*, s.*, concat(b.firstName, ' ', b.lastName) as borrower_name FROM ((tbl_transaction t INNER JOIN tbl_status s on s.ref_no = t.ref_no) INNER JOIN tbl_borrowers b on b.user_id = t.borrower_id) WHERE s.status_cashier = '2'";
                  $results = mysqli_query($conn, $sql);
                  while ($row = $results->fetch_assoc()) {
                    $ref_no = $row['ref_no'];
                    $borrower_name = $row['borrower_name'];
                    $amount = $row['amount'];
                    $loan_term = $row['loan_term'];
                  ?>
                    <tr>
                      <td class="text-center"><?= $i++ ?></td>
                      <td><?= $borrower_name ?></td>
                      <td><?= $ref_no ?></td>
                      <td><?= number_format($amount, 2) ?></td>
                      <td><?= $loan_term ?> Month/s</td>
                      <td class="text-center">
                        <a href="index.php?page=view-payments&refid=<?= $row['ref_no'] ?>" class="my-1 btn btn-warning text-white btn-xs" title="View Payments" data-toggle="tooltip" data-placement="top">
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
<?php endif; ?>